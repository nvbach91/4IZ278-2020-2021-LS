<?php
class OrdersDB extends Database {
    public function create($args) { 
        $input =
        [
            'id' => $args['id'],
            'date' => $args['date']
        ];

        $file = file($this->dbPath.'orders'.$this->dbExtension);
        $isExistingOrder = false;


            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $order =
                    [
                        'id' => $fields[0]
                    ];

                if ($order['id'] === $input['id']) {
                    $isExistingOrder = true;
                    break;
                }
            }

            if ($isExistingOrder) {
                echo "<br>Order with this id already exists";
            } else {$record = implode($this->delimiter, $input) . "\r\n";
                file_put_contents($this->dbPath.'orders'.$this->dbExtension, $record, FILE_APPEND);

                echo '<br>Order '. $args['id'] . " " . $args['date'] . ' was created', PHP_EOL; }


    }
    public function fetch($args)  { 

        $orderId = $args['id'];

        $output =
        [
            $number = '',
            $date = ''
        ];

        $file = file($this->dbPath.'orders'.$this->dbExtension);
        $isExistingOrder = false;


            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $order =
                    [
                        'id' => $fields[0],
                        'date' => $fields[1]
                    ];

                if ($order['id'] === $orderId) {
                    $isExistingOrder = true;
                    $output['number'] = $order['id'];
                    $output['date'] = $order['date'];
                    break;
                }
            }

            if ($isExistingOrder) {
                echo "<br>" . $output['number'] . " " . $output['date'];
                echo "<br>". 'An order was fetched', PHP_EOL;
            } else {echo "<br>" . 'Order not found';
                echo "<br>". 'Order was not fetched', PHP_EOL;}

        }

    public function save($args)   
    { 
        $orderId = $args['id'];
        $newDate = $args['date'];

        $output =
        [
            $number = '',
            $date = ''
        ];

        $file = file($this->dbPath.'orders'.$this->dbExtension);
        $isExistingOrder = false;


            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $order =
                    [
                        'id' => $fields[0],
                        'date' => $fields[1]
                    ];

                if ($order['id'] === $orderId) {
                    $order['date'] = $newDate;
                    $output['number'] = $order['id'];
                    $output['date'] = $order['date'];
                    $isExistingOrder = true;
                    break;
                }
            }

            if ($isExistingOrder) {
                $this -> delete(['id' => $orderId]);
                $this -> create(['id' => $orderId, 'date' => $newDate]);
                echo "<br>" . $output['number'] . " " . $output['date'];
                echo "<br>". 'An order was updated', PHP_EOL;
            } else {echo "<br>" . 'Order not found';
                echo "<br>". 'Order was not updated', PHP_EOL;}

    }
    public function delete($args) 
    {
        $orderId = $args['id'];
        $output =
        [
            $number = '',
            $date = ''
        ];

        $file = file($this->dbPath.'orders'.$this->dbExtension);
        $isExistingOrder = false;


            foreach ($file as $record) {
                if (!$record) {
                    continue;
                }
                $fields = explode(';', $record);
                $order =
                    [
                        'id' => $fields[0],
                        'date' => $fields[1]
                    ];

                if ($order['id'] === $orderId) {
                    $output['number'] = $order['id'];
                    $output['date'] = $order['date'];
                    $isExistingOrder = true;
                    $replace = str_replace($record,'',$file);
                    file_put_contents($this->dbPath.'orders'.$this->dbExtension,$replace);
                    break;
                }
            }

            if ($isExistingOrder) {
                echo "<br>" . $output['number'] . " " . $output['date'];
                echo '<br> An order was deleted', PHP_EOL;
            } else {echo "<br>" . 'Order not found';
                echo '<br> Order was not deleted', PHP_EOL; }


    }
}
?>
