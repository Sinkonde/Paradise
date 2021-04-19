<?php

use App\Models\Mark;

if(!function_exists('subjectWisePosition')){
    function subjectWisePosition($subject_id, $student_id){
        $out = [];
        foreach (Mark::where('subject_id',$subject_id)->get() as $mark) {
            $out[$mark->student_id] = $mark->mark;
        }
        arsort($out);

        //positioning
        $position = 0;
        $preValue = 0;
        $finalData = [];
        $rows = 0;

        foreach ($out as $key => $value)
        {
            $rows++;
            if($value != $preValue)
            {
                $preValue = $value;
                $position = $rows;
                $pos = $position;
            }
            else
            {
                $pos = $position;
            }
            $finalData[$key] = $pos;
        }

        return $finalData[$student_id];
    }
}

if(!function_exists('is_connected')){
    function is_connected(){
        $connected = @fsockopen("www.google.com",80);
        if ($connected) {
            fclose($connected);
            return true;
        }
        else return false;
    }
}

if (!function_exists('setCustomDate')){
    function setCustomDate($date, $day=true){
        $d = ['Mon'=>"Jumatatu", 'Tue'=>"Jumanne", 'Wed'=>"Jumatano", 'Thu'=>"Alhamisi", 'Fri' =>"Ijumaa", 'Sat'=>'Jumamosi', 'Sun' =>"Jumapili"];
        $m = ['Jan'=>"Januari", 'Feb' => 'Februari', 'Mar'=>'Machi', 'Apr'=> 'Aprili', 'May'=>"Mei", "Jun" =>"Juni",
              'Jul' => "Julai", 'Aug' => 'Agosti', 'Sep'=>'Septemba', 'Oct'=>"Oktoba",'Nov'=>"Novemba","Dec" =>"Disemba"];

        if($day){
            $o = $d[date('D',strtotime($date))];
        }
        else{
            $o = $m[date('M',strtotime($date))];
        }

        return $o;
    }
}

//Transform A Title Like
//from
//Mtihani wa muhula wa kwanza
//to
//Mtihani wa Muhula wa Kwanza
if(!function_exists('title')){
    function title($title){
        $array = explode(' ', strtolower($title));

        foreach ($array as $k => $v) {
            if (strlen($v) <= 3) {
                $array[$k] = strtolower($v);
            }
            else {
                $array[$k] = ucfirst($v);
            }
        }

        return ucfirst(implode(' ', $array));
    }
}

function addToTimeline($model, $message, $otherData = []){
    $model->timelines()->create(array_merge(['description'=>$message],$otherData));
}

//Calculate the grade of the mark
if(!function_exists('setGrade')){
    function setGrade($mark){
        switch ($mark) {
            case $mark > 100:
                $grade = null;
                break;

            case $mark > 80.4:
                $grade = 'A';
                break;

            case $mark > 60.4:
                $grade = 'B';
                break;

            case $mark > 40.4:
                $grade = 'C';
                break;

            case $mark > 20.4:
                $grade = 'D';
                break;

            case $mark > 0:
                $grade = 'E';
                break;

            default:
                $grade = null;
                break;
        }

        return $grade;
    }
}

//Calculate the grade of the mark
if(!function_exists('setComments')){
    function setComments($mark){
        switch ($mark) {
            case $mark > 100:
                $comment = null;
                break;

            case $mark > 80.4:
                $comment = 'Vizuri sana';
                break;

            case $mark > 60.4:
                $comment = 'Vizuri';
                break;

            case $mark > 40.4:
                $comment = 'Wastani';
                break;

            case $mark > 20.4:
                $comment = 'Hafifu';
                break;

            case $mark > 0:
                $comment = 'Dhaifu';
                break;

            default:
                $comment = null;
                break;
        }

        return $comment;
    }
}
