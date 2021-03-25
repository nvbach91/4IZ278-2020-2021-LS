<?php
class OrdersDB extends Database {
  
  public function create($args) {
    $orders = $this->fetchDB();
    $order['number'] = $args['number'];
    $order['date'] = $args['date'];
    array_push($orders, $order);
    $this->rewriteDB($orders);
    
    echo 'Order ', $args['number'], ' (' . (sizeof($orders) - 1) . ')', ' Date: ', $args['date'], ' was created', PHP_EOL; 
  }
  
  public function fetch($id) {
    $orders = $this->fetchDB();
    if (isset($orders[$id])) {
      echo 'Order ', $id,' was fetched', PHP_EOL;
      echo 'Number ', $orders[$id][0], ' Date: ', $orders[$id][1], PHP_EOL;
    } else {
      echo "Non-existing order", PHP_EOL;
    }
  }

  public function save($id, $args) {
    $orders = $this->fetchDB();
    if (isset($orders[$id])) {
      $orders[$id] = $args;
      $this->rewriteDB($orders);  

      echo 'Order ', $id,' was saved', PHP_EOL;
      echo 'Number ', $orders[$id]['number'], ' Date: ', $orders[$id]['date'], PHP_EOL;
    } else {
      echo "Non-existing order", PHP_EOL;
    }
  }
  
  public function delete($id) {
    $orders = $this->fetchDB();
    if (isset($orders[$id])) {
      $number = $orders[$id][0];
      $date = $orders[$id][1];
      unset($orders[$id]);
      $orders = array_values($orders);
      $this->rewriteDB($orders);
      echo 'Order ', $id,' was deleted', PHP_EOL;
      echo 'Number ', $number, ' Date: ', $date, PHP_EOL;
    } else {
      echo "Non-existing order", PHP_EOL;
    }
  }

}

$orders = new OrdersDB();
$orders->clearData(); //resetuje databázu
$orders->create(['number' => 42, 'date' => '2019-03-08']);
$orders->create(['number' => 59, 'date' => '2020-06-22']);
$orders->fetch(1);
$orders->save(0, ['number' => 66, 'date' => '2021-12-02']);
$orders->delete(1);
echo PHP_EOL;