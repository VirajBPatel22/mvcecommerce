<?php  
Class Admin_Block_Widget_Grid_Filter_Number extends Admin_Block_Widget_Grid_Filter_Abstract{
    protected $_data;
    public function __construct() {
        
    }
    public function setdata($data){
        $this->_data =$data;
        return $this;
    }
    
    public function getdata(){
        return $this->_data;
    }
    public function render(){
        return '<input type="number" placeholder = "min" name = "min"><input type = "number" placeholder = "max" name ="max">';
    }

}

?>