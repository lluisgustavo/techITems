<?php

Class Customer{
    private $error = "";   
    public function make_table($customers, $model = null){
        $result = "";
        if(is_array($customers)){   
            foreach($customers as $Customer){    

                $result .= '<tr>
                            <td>' . $Customer->id . '</td>
                            <td style="max-width: 150px; word-break: break-all">' . $Customer->name . '</td>
                            <td>' . $Customer->CPF . '</td>    
                            <td>' . $this->formatPhone($Customer->phone) . '</td>    
                            <td>' . date('d-m-Y', strtotime($Customer->birth)) . '</td>     
                    </tr>';    
            }
        }

        return $result;
    }

    protected function formatPhone($phone)
    {
        $formatedPhone = preg_replace('/[^0-9]/', '', $phone);
        $matches = [];
        preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $formatedPhone, $matches);
        if ($matches) {
            return '('.$matches[1].') '.$matches[2].'-'.$matches[3];
        }

        return $phone; // return number without format
    }
}