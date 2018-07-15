<h5 class="center grey-text text-darken-1">Cart Summary</h5>
<br>
<div class="divider"></div>
<table class="responsive-table">
    <tbody>
        <tr>
            <td>Subtotal:</td>
            <td>
                <span class="val">${{Cart::subtotal()}}</span>
            </td>
        </tr>
        <tr>
            <td>Shipping:</td>
            <td>
                <span class="val">${{Cart::tax()}}</span>
            </td>
        </tr>
        <tr>
            <td>Total:</td>
            <td>
                <span class="val">${{Cart::total()}}</span>
            </td>
        </tr>
    </tbody>
</table>
