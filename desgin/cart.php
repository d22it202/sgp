<?php

// start session to store cart items
session_start();

// define the available menu items
$menu = [
  ['id' => '1', 'name' => 'Pizza', 'price' => 10],
  ['id' => '2', 'name' => 'Burger', 'price' => 5],
  ['id' => '3', 'name' => 'Fries', 'price' => 3],
];

// check if the user has added an item to the cart
if(isset($_POST['add_to_cart'])) {
  $item_id = $_POST['item_id'];
  $item_qty = $_POST['item_qty'];

  // if the item is already in the cart, update the quantity
  if(isset($_SESSION['cart'][$item_id])) {
    $_SESSION['cart'][$item_id]['qty'] += $item_qty;
  } else {
    // add the new item to the cart
    $_SESSION['cart'][$item_id] = [
      'name' => $menu[$item_id-1]['name'],
      'price' => $menu[$item_id-1]['price'],
      'qty' => $item_qty,
    ];
  }
}

// check if the user has updated the cart items
if(isset($_POST['update_cart'])) {
  $cart = $_SESSION['cart'];
  foreach($_POST['item_qty'] as $item_id => $item_qty) {
    $cart[$item_id]['qty'] = $item_qty;
    $_SESSION['cart'] = $cart;
  }
}

// check if the user has deleted an item from the cart
if(isset($_POST['delete_item'])) {
  $item_id = $_POST['item_id'];
  unset($_SESSION['cart'][$item_id]);
}

// calculate the total price of the cart
$total_price = 0;
if(isset($_SESSION['cart'])) {
  foreach($_SESSION['cart'] as $item) {
    $total_price += $item['price'] * $item['qty'];
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Cart</title>
</head>
<body>
  
  <h1>Food Cart</h1>

  <h2>Menu</h2>
  <ul>
    <?php foreach($menu as $item): ?>
      <li>
        <?php echo $item['name']; ?> - $<?php echo $item['price']; ?>
        <form action="" method="post">
          <input type="hidden" name="item_id" value="<?php echo $item['id']; ?>">
          <input type="number" name="item_qty" value="1" min="1">
          <button type="submit" name="add_to_cart">Add to Cart</button>
        </form>
      </li>
    <?php endforeach; ?>
  </ul>

  
