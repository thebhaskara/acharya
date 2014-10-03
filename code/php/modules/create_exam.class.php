 <?php
class create_exam
{
    function insert_into_db($exam, $exam_parameters)
    {
        $exam_id = $exam->insert_into_db();
        $exam_obj = exam::load($exam_id);
        
        foreach($exam_parameters as $exam_parameter)
        {
            $exam_parameter->exam = $exam_obj;
            $exam_parameter->insert_into_db();
        }
        
        return $exam_id;
    }
}
?>