<?php
namespace App\Services\Admin;


class StoreService
{
    protected $wrongRequestAttributes;
    protected $wrongRequestMessages;

    public function __construct()
    {

    }

    /**
     * @param $requestAttributes
     * @return array messages
     * Checks if all arrays and array keys from request are inside the available whitelist array ($this->getAvailableAttributes())
     */
    public function getRequestArrayWrongMessages($requestAttributes)
    {
         foreach($requestAttributes as $name => $value){
             if(is_array($value)){
                 $this->checkRequestArrayPasses($name, $value);
             }
         }
         $this->setWrongRequestMessages();

         return $this->wrongRequestMessages;
    }

    /**
     * @param $name
     * @param $value
     * @return bool
     */
    protected function checkRequestArrayPasses($name,$value){

        $available = $this->getAvailableAttributes();

        if(!isset($available[$name])) {
            $this->wrongRequestAttributes['names'][] = $name;
            return false;
            // There is not an array with this name inside the available array.
        }
        foreach ($value as $attribute => $val ){
            if (!in_array($attribute, $available[$name])){
                $this->wrongRequestAttributes['attributes'][$name] = $attribute;
                return false;
                // The attribute is not exists inside the $available[$name] array.
                // For example if on our request we have something like address['wrongKey'], we don't have this in our available attributes
            }
        }

        return true;

    }

    /**
     * @return array
     * That is the whitelist array for our Property request. We get this from Config we already set in the AppServiceProvider
     */
    protected function getAvailableAttributes(){

        return config('settings')['property_available_fields'];

    }


    protected function setWrongRequestMessages(){
        if(!empty($this->wrongRequestAttributes['attributes'])){
            foreach ($this->wrongRequestAttributes['attributes'] as $name => $attribute){
                $this->wrongRequestMessages[] = trans('admin/general.wrong field') . " $name,$attribute";
            }
        }
        if(!empty($this->wrongRequestAttributes['names'])){
            foreach ($this->wrongRequestAttributes['names'] as $name){
                $this->wrongRequestMessages[] = trans('admin/general.wrong field') . " $name";
            }
        }
    }

}
