let cart = JSON.parse(localStorage.getItem("cart")) || [];

// ADD TO CART

function addToCart(id){


let product = products.find(item => item.id === id);



let existing = cart.find(item => item.id === id);



if(existing){


    existing.quantity++;

}
else{


    cart.push({

        ...product,
        quantity:1

    });


}



saveCart();


showToast();


updateCartCount();


}




// SAVE CART


function saveCart(){

localStorage.setItem(
"cart",
JSON.stringify(cart)
);

}





// REMOVE ITEM


function removeItem(id){


cart =
cart.filter(item => item.id !== id);


saveCart();

renderCart();


updateCartCount();


}





// INCREASE QUANTITY


function increaseQty(id){


let item =
cart.find(product=>product.id===id);


item.quantity++;


saveCart();

renderCart();


}





// DECREASE QUANTITY


function decreaseQty(id){


let item =
cart.find(product=>product.id===id);



if(item.quantity>1){


item.quantity--;

}

else{


removeItem(id);


}



saveCart();

renderCart();


}








// DISPLAY CART


function renderCart(){


let cartItems =
document.getElementById("cartItems");



if(!cartItems)
return;



cartItems.innerHTML="";

if(cart.length===0){

cartItems.innerHTML=`

<div class="emptyCart">

<h2>🛒 Your Cart is Empty</h2>

<p>Add products to start shopping.</p>



</div>

`;

document.getElementById("cartTotal").innerHTML="₹0";

return;

}

let total=0;



cart.forEach(item=>{


let subtotal =
item.price * item.quantity;



total += subtotal;



cartItems.innerHTML += `


<div class="cartProduct">


<img src="${item.image}">



<div>


<h3>

${item.name}

</h3>



<p>

₹${item.price}

</p>



<div class="quantity">


<button onclick="decreaseQty(${item.id})">

-

</button>



<span>

${item.quantity}

</span>



<button onclick="increaseQty(${item.id})">

+

</button>


</div>



</div>




<button 
class="remove"
onclick="removeItem(${item.id})">


❌


</button>



</div>



`;

});



document.getElementById("cartTotal").innerHTML = "₹" + total;
document.getElementById("subtotal").innerHTML = "₹" + total;



}








// CART COUNT


function updateCartCount(){


let count=0;



cart.forEach(item=>{


count += item.quantity;


});



let badge =
document.getElementById("cartCount");



let floating =
document.getElementById("floatingCount");



if(badge)
badge.innerText=count;



if(floating)
floating.innerText=count;



}








// TOAST MESSAGE


function showToast(){


let toast =
document.getElementById("toast");



if(toast){


toast.style.display="block";



setTimeout(()=>{


toast.style.display="none";


},2000);


}


}






updateCartCount();
