<?php 

$id = $this->getRequest()->getGet('cartId');
$placeOrder = $this->getPlaceOrder();
$placeOrder = $placeOrder->load($id);
$billing = $placeOrder->getBillingAddress();
$shipping = $placeOrder->getSHippingAddress();
$items = $placeOrder->getItems();

?>

<table border="1px solid black" width="100%" height="100%">
    <tr>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Discount</th>
    </tr>
    <?php if($items): ?>
        <?php foreach($items->getData() as $key=>$item): ?>
            <tr>
                <td><?php echo $item->getProductName(); ?></td>
                <td><?php echo $item->quantity; ?></td>
                <td><?php echo $item->basePrice; ?></td>
                <td><?php echo $item->discount; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan=8>No Record Found</td>
        </tr>
    <?php endif; ?>
</table>
<table border="1px" width="100%" height="100%">
    <tr>
        <td>
            <table width="100%" height="100%">
                <tr>
                    <th colspan=2>Billing Address</th>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo $placeOrder->getAddressValue('billing','address'); ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><?php echo $placeOrder->getAddressValue('billing','city'); ?></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td><?php echo $placeOrder->getAddressValue('billing','state'); ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td><?php echo $placeOrder->getAddressValue('billing','country'); ?></td>
                </tr>
                <tr>
                    <td>Zip Code</td>
                    <td><?php echo $placeOrder->getAddressValue('billing','zipcode'); ?></td>
                </tr>
            </table>
        </td>
        <td>
            <table width="100%" height="100%">
                <tr>
                    <th colspan=2>Shipping Address</th>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><?php echo $placeOrder->getAddressValue('shipping','address'); ?></td>
                </tr>
                <tr>
                    <td>City</td>
                    <td><?php echo $placeOrder->getAddressValue('shipping','city'); ?></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td><?php echo $placeOrder->getAddressValue('shipping','state'); ?></td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td><?php echo $placeOrder->getAddressValue('shipping','country'); ?></td>
                </tr>
                <tr>
                    <td>Zip Code</td>
                    <td><?php echo $placeOrder->getAddressValue('shipping','zipcode'); ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<table border="1px" width="100%" height="100%">

    <tr>
        <th>Payment Method</th>
        <td><?php echo $placeOrder->getPaymentName(); ?></td>
    </tr>
    <tr>
        <th>Shipping Method</th>
        <td><?php echo $placeOrder->getShippingName(); ?></td>
    </tr>
    <tr>
        <th>Total Price</th>
        <td><?php echo $placeOrder->total; ?></td>
    </tr>
    <tr>
        <th>Total Discount</th>
        <td><?php echo $placeOrder->discount; ?></td>
    </tr>
    <tr>
        <th>Shipping Charge</th>
        <td><?php echo $placeOrder->shippingAmount; ?></td>
    </tr>
    <tr>
        <th>Final Price</th>
        <td><?php echo $placeOrder->getFinalTotal(); ?></td>
    </tr>
</table>
<input type="button" onclick="mage.setUrl('<?php echo $this->getUrl()->getUrl('grid', 'product', [],true); ?>').load()" value="Home">