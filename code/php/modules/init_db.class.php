<?php

class init_db
{
    public static $inserted_level;
    public static $inserted_topic1;
    public static $inserted_topic2;
    public static $inserted_question_type;
    public static $inserted_scenario;
    public static $all_questions;
    public static $inserted_candidate;
    public static $inserted_examiner;
    public static $inserted_exam;
    public static $inserted_question_paper;
    public static $inserted_question_paper_detail;
    public static $inserted_result;
    public static $inserted_question_paper_status;
    
    public function create_scenario_relation()
    {
        $level  = new level();
        $level->text = 'beginner';
        $level->experience = 24;
        $level->correct_answer_weightage = 2.5;
        $level->wrong_answer_weightage = 0.5;
        init_db::$inserted_level = $level->insert_into_db();
        
        $topic1 = new topic();
        $topic1->text = 'c++';
        $topic1->parent_topic_id = 0;
        init_db::$inserted_topic1 = $topic1->insert_into_db();
        
        $topic2 = new topic();
        $topic2->text = 'inheritence';
        $topic2->parent_topic_id = init_db::$inserted_topic1;
        init_db::$inserted_topic2 = $topic2->insert_into_db();
        
        $question_type = new question_type();
        $question_type->type = 'objective';
        $question_type->description = 'only one answer correct';
        init_db::$inserted_question_type = $question_type->insert_into_db();
        
        $answer1 = array ('string', 'false');
        $answer2 = array ('char', 'false');
        $answer3 = array ('int', 'true');
        $answer4 = array ('float', 'false');
        
        $answers = array($answer1,$answer2,$answer3,$answer4);
        
        $question1 = new question();
        $question1->content = 'Solve this question 1';
        $question1->question_type_id = init_db::$inserted_question_type;
        $question1->time_limit = 60;
        $question1->level_id = init_db::$inserted_level;
        $question1->topic_ids = array(init_db::$inserted_topic1, init_db::$inserted_topic2);
        $question1->answers = $answers;
        
        $question2 = new question();
        $question2->content = 'Solve this question 2';
        $question2->question_type_id = init_db::$inserted_question_type;
        $question2->time_limit = 120;
        $question2->level_id = init_db::$inserted_level;
        $question2->topic_ids = array(init_db::$inserted_topic1, init_db::$inserted_topic2);
        $question2->answers = $answers;
        
        $questions = array($question1, $question2);
        
        $scenario = new scenario();
        $scenario->summary = "abc";
        $scenario->instruction = "xyz";
        $scenario->content = "as,duiyncvdfyv";
        
        $create_question = new create_question();
        init_db::$inserted_scenario = $create_question->insert_into_db($questions, $scenario);
        
        init_db::$all_questions = R::find(TABLE_QUESTION, 'scenario_id = :id',array(':id' => init_db::$inserted_scenario));
        
        
    }
    
    public function create_exam_relation()
    {
        $candidate               = new candidate();
        $candidate->first_name   = 'atul';
        $candidate->middle_name  = 'x';
        $candidate->last_name    = 'agrawal';
        $candidate->experience   = 24;
        $candidate->user_name    = 'test';
        $candidate->password     = 'test';
        init_db::$inserted_candidate      = $candidate->insert_into_db();
        
        $examiner                = new examiner();
        $examiner->first_name    = 'atul';
        $examiner->middle_name   = 'x';
        $examiner->last_name     = 'agrawal';
        $examiner->experience    = 24;
        $examiner->user_name     = 'test';
        $examiner->password      = 'test';
        init_db::$inserted_examiner       = $examiner->insert_into_db();        
        
        $exam = new exam();
        $exam->name = "C++ 4 yrs experience";
        $exam->experience = 24;
        $exam->total_questions = 10;
        $exam->duration = 120;
        $exam->examiner_id = init_db::$inserted_examiner;
        $exam->designation = "lead Engineer";
        $exam->marks = 100;
        
        $exam_parameter1 = new exam_parameter();
        $exam_parameter1->number_of_questions = 3;
        $exam_parameter1->topic_id = init_db::$inserted_topic2;
        $exam_parameter1->level_id = init_db::$inserted_level;
        
        $exam_parameter2 = new exam_parameter();
        $exam_parameter2->number_of_questions = 4;
        $exam_parameter2->topic_id = init_db::$inserted_topic2;
        $exam_parameter2->level_id = init_db::$inserted_level;
        
        $exam_parameters = array($exam_parameter1, $exam_parameter2);
        
        $create_exam = new create_exam();
        init_db::$inserted_exam = $create_exam->insert_into_db($exam, $exam_parameters);
        
        $question_paper_status          = new question_paper_status();
        $question_paper_status->status  = REVIEWED_READY_TO_ATEMPT;
        
        init_db::$inserted_question_paper_status = $question_paper_status->insert_into_db();
        
        $question_paper             = new question_paper();
        $question_paper->exam       = exam::load(init_db::$inserted_exam);
        $question_paper->candidate  = candidate::load(init_db::$inserted_candidate);
        $question_paper->status     = question_paper_status::load(init_db::$inserted_question_paper_status);
        
        init_db::$inserted_question_paper = $question_paper->insert_into_db();
        
        $question_paper_detail = new question_paper_detail();
        $question_paper_detail->question_paper = question_paper::load(init_db::$inserted_question_paper);
        
        foreach(init_db::$all_questions as $all_question)
        {
            $question_paper_detail->question = $all_question;
            break;
        }
        
        init_db::$inserted_question_paper_detail = $question_paper_detail->insert_into_db();
    }
    
    public function create_result_relation()
    {
        $result                     = new result();
        $result->candidate          = candidate::load(init_db::$inserted_candidate);
        $result->question_paper     = question_paper::load(init_db::$inserted_question_paper);
        $result->total_marks        = -10.5;
        init_db::$inserted_result   = $result->insert_into_db();
        
        foreach(init_db::$all_questions as $all_question)
        {
            $rs                = new result_detail();
            $rs->result        = result::load(init_db::$inserted_result);
            $rs->question      = $all_question;
            $rs->answer        = 'string';
            $rs->explanation   = 'explanation';
            $rs->weightage     = -0.5;
            $rs->insert_into_db();
        }
    }
    
    public function create_stored_procedures()
    {
        //$sql = 'DROP PROCEDURE IF EXISTS CREATEPAPERNEW';
        //R::exec($sql);
        //$sql = render("sql\queries\CreatePaperNew.sql");
        //R::exec($sql);
    }
    
    public function clear()
    {
        R::trash(level::load(init_db::$inserted_level));
        R::trash(topic::load(init_db::$inserted_topic1));
        R::trash(topic::load(init_db::$inserted_topic2));
        R::trash(question_type::load(init_db::$inserted_question_type));
        
        foreach(init_db::$all_questions as $all_question)
        {
            $all_answers = R::find(TABLE_ANSWER, 'question_id = :id',array(':id' => $all_question["id"]));
            $all_qtrel = R::find(TABLE_QUESTIONTOPICRELATION, 'question_id = :id',array(':id' => $all_question["id"]));
            
            foreach($all_answers as $all_answer)
            {
                R::trash($all_answer);
            }
            
            foreach($all_qtrel as $qt)
            {
                R::trash($qt);
            }
            
            R::trash($all_question);
        }
        
        R::trash(scenario::load(init_db::$inserted_scenario));
        
        R::trash(question_paper_detail::load(init_db::$inserted_question_paper_detail));
        R::trash(question_paper::load(init_db::$inserted_question_paper));
        R::trash(question_paper_status::load(init_db::$inserted_question_paper_status));
        
        $all_exam_parameters = R::find(TABLE_EXAMPARAMETERS, 'exam_id = :id',array(':id' => init_db::$inserted_exam));
        
        foreach($all_exam_parameters as $all_exam_parameter)
        {
            R::trash($all_exam_parameter);
        }
        
        R::trash(exam::load(init_db::$inserted_exam));
        R::trash(candidate::load(init_db::$inserted_candidate));
        R::trash(examiner::load(init_db::$inserted_examiner));
        
        $all_result_details = R::find(TABLE_RESULTDETAIL, 'result_id = :id',array(':id' => init_db::$inserted_result));
        
        foreach($all_result_details as $all_result_detail)
        {
            R::trash($all_result_detail);
        }
        
        R::trash(result::load(init_db::$inserted_result));
        
        echo 'tables created';
    }
    
}
?>
