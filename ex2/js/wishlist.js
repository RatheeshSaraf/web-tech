let wishlist =
JSON.parse(localStorage.getItem("wishlist")) || [];





function addWishlist(id){


let product =
products.find(item=>item.id===id);



let exists =
wishlist.find(item=>item.id===id);



if(!exists){


wishlist.push(product);


localStorage.setItem(
"wishlist",
JSON.stringify(wishlist)
);


showToast();


}



}





function removeWishlist(id){


wishlist =
wishlist.filter(
item=>item.id!==id
);



localStorage.setItem(
"wishlist",
JSON.stringify(wishlist)
);



displayWishlist();


}






function displayWishlist(){


let box =
document.getElementById(
"wishlistItems"
);



if(!box)
return;



box.innerHTML="";



wishlist.forEach(item=>{


box.innerHTML += `


<div class="productCard">


<img src="${item.image}">


<h3>${item.name}</h3>


<p>

₹${item.price}

</p>


<button class="addBtn"

onclick="addToCart(${item.id})">

Move To Cart

</button>



<button

onclick="removeWishlist(${item.id})">

Remove ❤️

</button>



</div>


`;

});


}