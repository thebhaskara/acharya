DELIMITER $$
CREATE PROCEDURE CREATEEXAM (IN examid INT)#, IN number_of_question_papers INT)
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
        
        DECLARE question_selected_counter INT DEFAULT 0;
        DECLARE question_counter INT DEFAULT 0;

        DECLARE scenario_selected INT DEFAULT 0;
        DECLARE temp_count INT DEFAULT 0;

        DECLARE temp_question_id INT DEFAULT 0;

        DECLARE extra_questions INT DEFAULT 0;

		DECLARE temp INT DEFAULT 0;

        SELECT total_questions, duration, marks INTO total_number_of_questions, exam_duration, total_marks
        FROM exam WHERE id = examid;

        #create a temp table with all the exam parameters for a particular exam
        DROP TABLE IF EXISTS examparameters;
        CREATE TEMPORARY TABLE IF NOT EXISTS examparameters AS (Select * FROM examparameter where exam_id = examid);
        SET exam_parameter_count = (Select count(1) FROM examparameters);
        #END

        #WHILE number_of_question_papers > 0 DO
            INSERT INTO questionpaper (exam_id) VALUES (examid);
            SET question_paper_number = (SELECT id FROM questionpaper WHERE exam_id = examid ORDER BY id DESC LIMIT 1);
            WHILE temp_counter < exam_parameter_count DO
                SELECT number_of_questions, topic_id, level_id INTO questions, topic, difficulty_level
                FROM examparameters
                WHERE exam_id = examid
                ORDER BY id
                LIMIT temp_counter, 1;

                #CREATE TEMPORARY TABLE IF NOT EXISTS questionlist AS 
                #(SELECT question_id INTO FROM questiontopicrelation
                #WHERE topic_id = topic);

                DROP TABLE IF EXISTS questionlist;

                CREATE TEMPORARY TABLE IF NOT EXISTS questionlist AS(
                SELECT * FROM question
                WHERE scenario_id in (
                SELECT scenario_id FROM question q
                INNER JOIN questiontopicrelation qt ON qt.question_id = q.id
                WHERE qt.topic_id = topic
                AND q.level_id = difficulty_level
                GROUP BY scenario_id
                HAVING COUNT(1) >= 2));

                DROP TABLE IF EXISTS scenariolist;
                CREATE TEMPORARY TABLE IF NOT EXISTS scenariolist AS(
                SELECT * FROM scenario
                WHERE id in (SELECT DISTINCT scenario_id FROM questionlist)
                ORDER BY id);

                WHILE question_selected_counter < questions DO

                    SELECT id INTO scenario_selected FROM scenariolist
                    ORDER BY usage_count
                    LIMIT question_counter, 1;

                    SET temp_count = (SELECT COUNT(1) FROM questionlist WHERE scenario_id = scenario_selected);

                    SET question_selected_counter = question_selected_counter + temp_count;
                    SET question_counter = question_counter + 1;

                    #WHILE temp_count > 0 DO
#
					#	SET temp = temp_count - 1;
#
                    #    SELECT id INTO temp_question_id
                    #    FROM questionlist
                    #    WHERE scenario_id = scenario_selected
                    #    ORDER BY id DESC
                    #    LIMIT temp, 1;
#
                    #    INSERT INTO questionpaperdetail (question_paper_id, question_id) 
                    #    VALUES(question_paper_number, temp_question_id);
                    #    SET temp_count = temp_count - 1;
                    #END WHILE;

                    INSERT INTO questionpaperdetail (question_paper_id, question_id)
                    SELECT question_paper_number, id FROM questionlist WHERE scenario_id = scenario_selected;

                    UPDATE scenario
                    SET usage_count = usage_count + 1
                    WHERE id = scenario_selected;

                    #SET temp_count = 0;

                END WHILE;

                IF question_selected_counter <> questions THEN
				
					SET extra_questions = question_selected_counter - questions;
					
                    DROP TABLE IF EXISTS extraquestions;
					CREATE TEMPORARY TABLE IF NOT EXISTS extraquestions AS(
					SELECT question_id FROM questionpaperdetail
                    WHERE question_paper_id = question_paper_number
                    ORDER BY question_id DESC
                    LIMIT extra_questions);
                    
                    DELETE FROM questionpaperdetail
                    WHERE question_id IN (SELECT question_id FROM extraquestions)
					AND question_paper_id = question_paper_number;
                END IF;

                SET question_selected_counter = 0;
                SET question_counter = 0;				
				SET temp_counter = temp_counter + 1;
				
            END WHILE;

            UPDATE question
            SET usage_count = (usage_count + 1)
            WHERE id IN (SELECT question_id FROM questionpaperdetail WHERE question_paper_id = question_paper_number);

            SET temp_counter = 0;
          #  number_of_question_papers = number_of_question_papers - 1;
        #END WHILE;


END$$
DELIMITER ;