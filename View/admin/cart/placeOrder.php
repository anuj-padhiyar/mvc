<?php 

echo $id = $this->getRequest()->getGet('cartId');
$placeOrder = $this->getPlaceOrder();
$placeOrder = $placeOrder->load($id);

echo "<pre>";
print_r($placeOrder);
$items = $placeOrder->getItems();
print_r($items);
die;

?>

<table height="100%" width="100%" border="2">
    <tr>
        <th>hello</th>
        <td>Hello</td>
    </tr>
    <tr>
        <th>friends</th>
        <td>Friends</td>
    </tr>
</table>