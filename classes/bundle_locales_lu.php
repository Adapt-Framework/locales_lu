<?php

namespace adapt\locales\lu{
    
    /* Prevent Direct Access */
    defined('ADAPT_STARTED') or die;
    
    class bundle_locales_lu extends \adapt\bundle{
        
        public function __construct($data){
            parent::__construct('locales_lu', $data);
        }
        
        public function boot(){
            if (parent::boot()){
                
                /* Add the validators */
                $this->sanitize->add_validator('lu_phone', "^(\+352)?[1-9]{3,11}$");
                $this->sanitize->add_validator('lu_mobile_phone', "^(\+352)?6[0-9]1[0-9]{6,6}$");
                
                $this->sanitize->add_validator('lu_postcode', "^[0-9]{4,4}$");
                
                /* Add formatters */
                $this->sanitize->add_format(
                    "lu_mobile_phone",
                    function($value){
                        return substr($value, 0, 3) . ' ' . substr($value, 3, 3) . ' ' . substr($value, 6, 3);
                    },
                    "function(value){
                        return value.substr(0,3) + ' ' + value.substr(3,3) + ' ' + value.substr(6,3);
                    }"
                );
                
                $this->sanitize->add_format('lu_date',
                    function($value){
                        return \adapt\date::convert_date('Y-m-d', 'd.m.Y', $value);
                    },
                    "function(value){
                        return adapt.date.convert_date('Y-m-d', 'd.m.Y', value);
                    }"
                );
                
                $this->sanitize->add_format('lu_time',
                    function($value){
                        return \adapt\date::convert_date('H:i:s', 'H:i', $value);
                    },
                    "function(value){
                        return adapt.date.convert_date('H:i:s', 'H:i', value);
                    }"
                );
                
                $this->sanitize->add_format('lu_datetime',
                    function($value){
                        return \adapt\date::convert_date('Y-m-d H:i:s', 'd.m.Y H:i', $value);
                    },
                    "function(value){
                        return adapt.date.convert_date('Y-m-d H:i:s', 'd.m.Y H:i', value);
                    }"
                );
                
                
                /* Add unformatters */
                
                $this->sanitize->add_unformat('lu_time',
                    function($value){
                        $value = preg_replace("/[^0-9]/", '', $value);
                        return \adapt\date::convert_date('Hi', 'H:i:s', $value);
                    },
                    "function(value){
                        value = value.replace(/[^0-9]/g, '');
                        return adapt.date.convert_date('Hi', 'H:i:s', value);
                    }"
                );
                
                $this->sanitize->add_unformat('lu_datetime',
                    function($value){
                        $value = preg_replace("/[^0-9]/", '', $value);
                        return \adapt\date::convert_date('dmYHi', 'Y-m-d H:i:s', $value);
                    },
                    "function(value){
                        value = value.replace(/[^0-9]/g, '');
                        return adapt.date.convert_date('YmdHi', 'Y-m-d H:i:s', value);
                    }"
                );
                    
                $this->sanitize->add_unformat('lu_date',
                    function($value){
                        $value = preg_replace("/[^0-9]/", '', $value);
                        return \adapt\date::convert_date('dmY', 'Y-m-d', $value);
                    },
                    "function(value){
                        value = value.replace(/[^0-9]/g, '');
                        return adapt.date.convert_date('dmY', 'Y-m-d', value);
                    }"
                );

                
                return true;
            }
            
            return false;
        }
        
    }
    
    
}

?>