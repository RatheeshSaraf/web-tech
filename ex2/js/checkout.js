let discountAmount = 0;



function calculateCheckout(){


let subtotal = 0;



cart.forEach(item=>{


subtotal += item.price * item.quantity;


});



let gst =
subtotal * 0.18;



let delivery =
subtotal >= 5000 ? 0 : 100;



let total =
subtotal +
gst +
delivery -
discountAmount;



document.getElementById("subtotal")
.innerText=subtotal;



document.getElementById("gst")
.innerText=Math.round(gst);



document.getElementById("delivery")
.innerText=delivery;



document.getElementById("discount")
.innerText=discountAmount;



document.getElementById("grandTotal")
.innerText=Math.round(total);



}





function applyCoupon(){


let code =
document.getElementById("coupon").value;



if(code==="SAVE10"){


discountAmount=500;


alert("₹500 Discount Applied");


}

else if(code==="STUDENT20"){


discountAmount=1000;


alert("Student Discount Applied");


}

else{


alert("Invalid Coupon");


}



calculateCheckout();


}







function placeOrder(){

    let name = document.getElementById("name").value;

    if(name.trim()==""){
        alert("Enter Customer Name");
        return;
    }

    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    let total = 0;

    cart.forEach(item=>{
        total += item.price * item.quantity;
    });

    let order = {

        customerName: name,

        date: new Date().toLocaleString(),

        items: cart,

        total: total,

        invoiceNo: "INV" + Date.now()

    };

    localStorage.setItem("order", JSON.stringify(order));

    localStorage.removeItem("cart");

    window.location.href="invoice.html";

}



calculateCheckout();