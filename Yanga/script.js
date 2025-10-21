function buyNow(productName, price) {
    document.getElementById("selectedItem").innerText = "You are buying: " + productName + " - $" + price.toFixed(2);
    document.getElementById("product").value = productName;
    document.getElementById("price").value = price;
    document.getElementById("paymentPopup").style.display = "flex";
}
