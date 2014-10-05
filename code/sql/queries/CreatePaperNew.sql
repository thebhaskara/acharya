DELIMITER $$
CREATE PROCEDURE CREATEPAPERNEW (IN examid INT, IN candidateid INT)
BEGIN
        #BEGIN
        DECLARE total_number_of_questions INT DEFAULT 0;
        DECLARE exam_duration INT DEFAULT 0;
        DECLARE total_marks INT DEFAULT 0;
        
        DECLARE exam_parameter_count INT DEFAULT 0;
        DECLARE questions INT DEFAULT 0;
        DECLARE topic INT DEFAULT 0;
        DECLARE difficulty_level INT DEFAULT 0;
        DECLARE temp_counter INT DEFAULT 0;
        DECLARE question_paper_number INT DEFAULT 0;
        DECLARE currenttime DATETIME;

        SET currenttime = DATE_FORMAT(NOW(),'%Y-%m-%d %H:%i:%s');

        SELECT total_questions, duration, marks INTO total_number_of_questions, exam_duration, total_marks
        FROM exam WHERE id = examid;

        #create a temp table with all the exam parameters for a particular exam
        DROP TABLE IF EXISTS examparameters;
        CREATE TEMPORARY TABLE IF NOT EXISTS examparameters AS (Select * FROM examparameter where exam_id = examid);
        SET exam_parameter_count = (Select count(1) FROM examparameters);
        #END

        INSERT INTO questionpaper (exam_id, candidate_id, insert_time, last_updated_time)
                           VALUES (examid, candidateid, currenttime, currenttime);

        SET question_paper_number = (SELECT id FROM questionpaper WHERE exam_id = examid ORDER BY id DESC LIMIT 1);

        WHILE temp_counter < exam_parameter_count DO
            SELECT number_of_questions, topic_id, level_id INTO questions, topic, difficulty_level
            FROM examparameters
            WHERE exam_id = examid
            ORDER BY id
            LIMIT temp_counter, 1;

            DROP TABLE IF EXISTS scenariolist;
            CREATE TEMPORARY TABLE IF NOT EXISTS scenariolist AS(
            SELECT scenario_id FROM question q
            INNER JOIN questiontopicrelation qt ON qt.question_id = q.id
            WHERE qt.topic_id = topic
            AND q.level_id = difficulty_level
            GROUP BY scenario_id
            HAVING COUNT(1) >= 2);

            DROP TABLE IF EXISTS questionscenariolist;
            CREATE TEMPORARY TABLE IF NOT EXISTS questionscenariolist AS(
            SELECT q.id question_number, s.id scenario_number FROM question q
            INNER JOIN scenariolist sl ON sl.scenario_id = q.scenario_id
            INNER JOIN scenario s ON s.id = sl.scenario_id
            ORDER BY s.usage_count, s.id, q.usage_count, q.id);

            #SELECT * FROM questionscenariolist;

            INSERT INTO questionpaperdetail (question_paper_id, question_id, insert_time, last_updated_time)
            SELECT question_paper_number, question_number, currenttime, currenttime FROM questionscenariolist
            WHERE question_number NOT IN (SELECT question_id FROM questionpaperdetail WHERE question_paper_id = question_paper_number)
            LIMIT 0, questions;

		SET temp_counter = temp_counter + 1;
        END WHILE;

        UPDATE question q
        INNER JOIN questionpaperdetail qpd ON qpd.question_id = q.id
        INNER JOIN scenario s ON s.id = q.scenario_id
        SET q.usage_count = (q.usage_count + 1), s.usage_count = (s.usage_count + 1)
        WHERE qpd.question_paper_id = question_paper_number;

        UPDATE questionpaper qp, questionpaperstatus qps
        SET qp.status_id = qps.id
        WHERE qps.status = 'reviewed and ready to attempt'
        AND qp.id = question_paper_number;

        SET temp_counter = 0;


END$$
DELIMITER ;