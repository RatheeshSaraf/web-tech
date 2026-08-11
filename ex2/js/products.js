const products = [

{
id:1,
name:"Premium Laptop",
category:"Electronics",
price:65000,oldPrice:75000,
sale:true,
image:"images/product1.jpg",
rating:4
},

{
id:2,
name:"Smart Phone",
category:"Electronics",
price:25000,oldPrice:75000,
sale:true,
image:"images/product2.jpg",
rating:4
},

{
id:3,
name:"Wireless Headphones",
category:"Electronics",
price:2999,oldPrice:75000,
sale:true,
image:"images/product3.jpg",
rating:5
},

{
id:4,
name:"Smart Watch",
category:"Watches",
price:4999,oldPrice:75000,
sale:true,
image:"images/product4.jpg",
rating:4
},

{
id:5,
name:"Gaming Keyboard",
category:"Accessories",
price:3500,oldPrice:75000,
sale:true,
image:"images/product5.jpg",
rating:5
},


{
id:6,
name:"Sports Shoes",
category:"Shoes",
price:4500,oldPrice:75000,
sale:true,
image:"images/product6.jpg",
rating:5
},


{
id:7,
name:"Running Shoes",
category:"Shoes",
price:3200,oldPrice:75000,
sale:true,
image:"images/product7.jpg",
rating:4
},


{
id:8,
name:"Leather Jacket",
category:"Fashion",
price:7000,oldPrice:75000,
sale:true,
image:"images/product8.jpg",
rating:5
},


{
id:9,
name:"Casual Shirt",
category:"Fashion",
price:1500,oldPrice:75000,
sale:true,
image:"images/product9.jpg",
rating:4
},


{
id:10,
name:"Designer Jeans",
category:"Fashion",
price:2800,oldPrice:75000,
sale:true,
image:"images/product10.jpg",
rating:4
},


{
id:11,
name:"Luxury Watch",
category:"Watches",
price:12000,oldPrice:75000,
sale:true,
image:"images/product11.jpg",
rating:5
},


{
id:12,
name:"Backpack",
category:"Accessories",
price:2200,oldPrice:75000,
sale:true,
image:"images/product12.jpg",
rating:4
},


{
id:13,
name:"Bluetooth Speaker",
category:"Electronics",
price:3999,oldPrice:75000,
sale:true,
image:"images/product13.jpg",
rating:5
},


{
id:14,
name:"Tablet",
category:"Electronics",
price:18000,oldPrice:75000,
sale:true,
image:"images/product14.jpg",
rating:4
},


{
id:15,
name:"Camera",
category:"Electronics",
price:45000,oldPrice:75000,
sale:true,
image:"images/product15.jpg",
rating:5
},


{
id:16,
name:"Sunglasses",
category:"Accessories",
price:1800,oldPrice:75000,
sale:true,
image:"images/product16.jpg",
rating:4
},


{
id:17,
name:"Hoodie",
category:"Fashion",
price:2500,oldPrice:75000,
sale:true,
image:"images/product17.jpg",
rating:5
},


{
id:18,
name:"Formal Shoes",
category:"Shoes",
price:5500,oldPrice:75000,
sale:true,
image:"images/product18.jpg",
rating:4
},


{
id:19,
name:"Gaming Mouse",
category:"Accessories",
price:1600,oldPrice:75000,
sale:true,
image:"images/product19.jpg",
rating:5
},


{
id:20,
name:"Monitor",
category:"Electronics",
price:15000,oldPrice:75000,
sale:true,
image:"images/product20.jpg",
rating:4
},


{
id:21,
name:"Power Bank",
category:"Electronics",
price:1200,oldPrice:75000,
sale:true,
image:"images/product21.jpg",
rating:4
},


{
id:22,
name:"Cap",
category:"Fashion",
price:700,oldPrice:75000,
sale:true,
image:"images/product22.jpg",
rating:4
},


{
id:23,
name:"Wallet",
category:"Accessories",
price:900,oldPrice:75000,
sale:true,
image:"images/product23.jpg",
rating:5
},


{
id:24,
name:"Earbuds",
category:"Electronics",
price:2200,oldPrice:75000,
sale:true,
image:"images/product24.jpg",
rating:5
},


{
id:25,
name:"Office Chair",
category:"Accessories",
price:9000,oldPrice:75000,
sale:true,
image:"images/product25.jpg",
rating:4
}


];





// Display Products

const productContainer =
document.getElementById("productContainer");



function displayProducts(items){


productContainer.innerHTML="";


items.forEach(product=>{


productContainer.innerHTML += `


<div class="productCard">


${product.sale ? 
'<span class="sale">SALE</span>' 
: ''}



<img src="${product.image}">



<button class="wishBtn"
onclick="addWishlist(${product.id})">

❤️

</button>




<h3>

${product.name}

</h3>



<p>

${product.category}

</p>



<div class="price">


₹${product.price}


<del>

₹${product.oldPrice}

</del>


</div>




<p>

${"⭐".repeat(product.rating)}

</p>




<button class="addBtn"

onclick="addToCart(${product.id})">

Add To Cart

</button>



</div>


`;  

});


}




displayProducts(products);






// Search Feature


const searchBox =
document.getElementById("search");



searchBox.addEventListener("keyup",()=>{


let value =
searchBox.value.toLowerCase();



let filtered =
products.filter(product=>

product.name
.toLowerCase()
.includes(value)

);



displayProducts(filtered);


});






// Category Filter


const categoryButtons =
document.querySelectorAll(".category");



categoryButtons.forEach(button=>{


button.addEventListener("click",()=>{


let category =
button.innerText;



if(category==="All"){


displayProducts(products);


}

else{


let result =
products.filter(product=>

product.category===category

);


displayProducts(result);


}



});


});