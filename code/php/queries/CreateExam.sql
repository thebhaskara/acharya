DELIMITER $$
CREATE PROCEDURE CREATEEXAM (IN examid INT, IN number_of_question_papers INT)
BEGIN
        #BEGIN
        DECLARE total_number_of_questions INT DEFAULT 0;
        DECLARE exam_duration INT DEFAULT 0;
        DECLARE total_marks INT DEFAULT 0;
        
        SELECT total_questions, duration, marks INTO total_number_of_questions, exam_duration, total_marks
        from exam WHERE exam_id = examid;
        
        DECLARE exam_parameter_count INT DEFAULT 0;
        DECLARE questions INT DEFAULT 0;
        DECLARE topic INT DEFAULT 0;
        DECLARE difficulty_level INT DEFAULT 0;
        DECLARE counter INT DEFAULT 1;
        DECLARE question_paper_number INT DEFAULT 0;
        
        #create a temp table with all the exam parameters for a particular exam
        CREATE TEMPORARY TABLE IF NOT EXISTS exam_parameters AS (Select * from examparameters where exam_id = examid);
        SET exam_parameter_count = Select count(1) from exam_parameters;
        #END

        #WHILE number_of_question_papers > 0 DO
            INSERT INTO question_paper (exam_id) VALUES (examid);
            question_paper_number = SELECT id FROM question_paper WHERE exam_id = examid ORDER BY id DESC LIMIT 1;
            WHILE counter <= exam_parameter_count DO
                SELECT number_of_questions, topic_id, level_id INTO questions, topic, difficulty_level
                FROM exam_parameters ORDER BY id LIMIT counter - 1, 1
                counter = counter + 1;
                
                #CREATE TEMPORARY TABLE IF NOT EXISTS question_list AS 
                #(SELECT question_id INTO from questiontopicrelation
                #WHERE topic_id = topic);
    
                CREATE TEMPORARY TABLE IF NOT EXISTS question_list AS(
                SELECT * from question
                WHERE id in (SELECT question_id from questiontopicrelation WHERE topic_id = topic)
                AND level_id = difficulty_level
                GROUP BY scenario_id
                HAVING COUNT(1) >= 3
                ORDER BY scenario_id);

                CREATE TEMPORARY TABLE IF NOT EXISTS scenario_list AS(
                SELECT * FROM scenario
                WHERE id in (SELECT DISTINCT scenario_id FROM question_list)
                ORDER BY id);
    
                DECLARE question_selected_counter INT DEFAULT 0;
                DECLARE question_counter INT DEFAULT 0;
    
                WHILE question_selected_counter < questions DO
                    DECLARE scenario_selected INT DEFAULT 0;
                    DECLARE temp_count INT DEFAULT 0;
                    SELECT id INTO scenario_selected from scenario_list
                    ORDER BY usage_count
                    LIMIT question_counter, 1;
                    SET temp_count = SELECT COUNT(1) FROM question_list WHERE scenario_id = scenario_selected;
                    question_selected_counter = question_selected_counter + temp_count;
                    question_counter = question_counter + 1;
                        WHILE temp_count > 0 DO
                        INSERT INTO question_paper_detail (question_paper_id, scenario_id);
                        END WHILE;
                END WHILE;
                question_selected_counter = 0;
                question_counter = 0;
            END WHILE;
            counter = 0;
          #  number_of_question_papers = number_of_question_papers - 1;
        #END WHILE;


END$$
DELIMITER ;
