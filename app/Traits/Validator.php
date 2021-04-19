<?php
namespace App\Traits;

// This trait is simple validate the request input

trait Validator {

    //This function is the called to validate the input data
    //it accept two parameters, $request form Request $request of the type hinting of caller
    //the second parameter is the association array of inputs with rules eg ['required' => ['first_name', 'second_name'], 'bail' => 'age']
    //it return false on fail
    function validation($request, $data=[]){

        $formatValidation = $this->formatValidations($data);
        if(is_array($formatValidation)){
            $request->validate($formatValidation);
        }
        else{
            return false;
            exit;
        }
    }

    //this function format the data into $request->validate() acceptable array
    //it return false if $data values has nested array and it return array if success
    function formatValidations($data = []){
        $out = [];
        if (!empty($data)) {
            foreach ($data as $rule => $fields) {
                if (is_array($fields)) {
                    foreach ($fields as $field) {
                        if(is_array($field)){
                            return false;
                        }
                        $out = $out + [$field => $rule];
                    }
                }
                else{
                    $out = $out + [$fields => $rule];
                }
            }
        }

        return $out;
    }
}
