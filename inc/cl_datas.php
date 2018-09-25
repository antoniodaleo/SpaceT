<?php
    //    classe para tratamento de classe

    class DATAS {
        public static function DataHoraAtualBD(){
            // Retorna a data e a hora autal formatada para mysql
            $data = new DateTime(); 
            return $data->format('Y-m-d H:i:s');

        }
    }


?>