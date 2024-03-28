document.addEventListener("DOMContentLoaded", function () {
  const modalOpenButtons = document.querySelectorAll("[data-modal-target]");
  const modalCloseButtons = document.querySelectorAll("[data-modal-toggle]");

  modalOpenButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const modal = document.querySelector(button.dataset.modalTarget);
      openModal(modal);
    });
  });

  modalCloseButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const modal = button.closest(".mode");
      closeModal(modal);
    });
  });

  function openModal(modal) {
    if (modal == null) return;
    modal.classList.remove("hidden");
    modal.setAttribute("aria-hidden", "false");
    document.body.classList.add("modal-open");
  }

  function closeModal(modal) {
    if (modal == null) return;
    modal.classList.add("hidden");
    modal.setAttribute("aria-hidden", "true");
    document.body.classList.remove("modal-open");
  }
});

document.addEventListener("DOMContentLoaded", () => {
  const cartItemsContainer = document.getElementById("cartItems");
  const totalHeader = document.getElementById("totalHeader");
  const totalSection = totalHeader.querySelector(".total");
  const cartEmptyMessage = document.querySelector(".cart-empty-message");
  const productImages = getProductImages();
  const productDescriptions = getProductDescription();
  const productDiscounts = getProductDiscount();

  function displayCartItems() {
    while (cartItemsContainer.firstChild) {
      cartItemsContainer.firstChild.remove();
    }

    let totalAmount = 0;
    let itemCount = 0;

    for (let i = 0; i < localStorage.length; i++) {
      const key = localStorage.key(i);
      if (key && key.startsWith("product_")) {
        const productName = localStorage.getItem(key);
        const quantityKey = `quantity_${key}`;
        const productQuantity =
          parseInt(localStorage.getItem(quantityKey)) || 0;
        itemCount += productQuantity;

        const cartItem = document.createElement("div");
        cartItem.classList.add("cartItem");
        cartItem.setAttribute("data-key", key);

        const image = document.createElement("img");
        image.src = productImages[productName];
        image.alt = productName;
        image.classList.add("productImage");

        const itemInfo = document.createElement("div");
        itemInfo.classList.add("itemInfo");

        const itemName = document.createElement("span");
        itemName.textContent = productName;

        const itemDescription = document.createElement("p");
        itemDescription.textContent = productDescriptions[productName];

        const quantity = document.createElement("span");
        const decreaseButton = document.createElement("button");
        decreaseButton.textContent = "-";
        decreaseButton.classList.add("quantityButton");
        decreaseButton.addEventListener("click", () => {
          updateQuantity(key, -1);
        });

        const increaseButton = document.createElement("button");
        increaseButton.textContent = "+";
        increaseButton.classList.add("quantityButton");
        increaseButton.addEventListener("click", () => {
          updateQuantity(key, 1);
        });

        quantity.appendChild(decreaseButton);
        quantity.appendChild(document.createTextNode(` ${productQuantity} `));
        quantity.appendChild(increaseButton);

        const amount = document.createElement("span");
        const productPrice = getProductPrice(productName);
        const productAmount = (productQuantity * productPrice).toFixed(2);
        amount.textContent = `${productAmount}`;

        const discount = document.createElement("span");
        const productDiscount = productDiscounts[productName];
        discount.textContent = `Discount: ${productDiscount}`;

        totalAmount += parseFloat(productAmount);

        const removeButton = document.createElement("button");
        removeButton.textContent = "Remove";
        removeButton.classList.add("removeButton");
        removeButton.addEventListener("click", () => {
          localStorage.removeItem(key);
          localStorage.removeItem(quantityKey);
          displayCartItems();
          updateCartCount();
        });

        itemInfo.appendChild(itemName);
        itemInfo.appendChild(itemDescription);
        cartItem.appendChild(image);
        cartItem.appendChild(itemInfo);
        cartItem.appendChild(discount);
        cartItem.appendChild(quantity);
        cartItem.appendChild(amount);
        cartItem.appendChild(removeButton);
        cartItemsContainer.appendChild(cartItem);
      }
    }

    const totalAmountElement = document.getElementById("totalAmount");
    totalAmountElement.textContent = `Total: ${totalAmount.toFixed(2)}`;

    // Toggle the visibility of the payment section and empty cart message based on cart content
    totalSection.style.display = itemCount > 0 ? "block" : "none";
    cartEmptyMessage.style.display = itemCount > 0 ? "none" : "flex";
  }

  function updateQuantity(productKey, quantityChange) {
    const quantityKey = `quantity_${productKey}`;
    const currentQuantity = parseInt(localStorage.getItem(quantityKey)) || 0;
    const newQuantity = Math.max(currentQuantity + quantityChange, 0);
    localStorage.setItem(quantityKey, newQuantity.toString());
    displayCartItems();
    updateCartCount();
  }

  function updateCartCount() {
    const cartCount = document.getElementById("cartCount");
    if (cartCount) {
      let count = 0;
      for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        if (key && key.startsWith("product_")) {
          count++;
        }
      }
      cartCount.textContent = count.toString();
    }
  }

  function getProductImages() {
    return {
      "Shoes 1": "images/item1.webp",
      "Shoes 2": "images/item2.jpeg",
      "Shoes 3": "images/item3.jpeg",
      "Shoes 4": "images/item4.jpeg",
      "Bag 1": "images/bag1.jpeg",
      "Bag 2": "images/bag2.webp",
      "Bag 3": "images/bag3.jpeg",
      "Bag 4": "images/bag4.jpeg",
      "Watch 1": "images/watch1.jpeg",
      "Watch 2": "images/watch2.webp",
      "Watch 3": "images/watch3.jpeg",
      "Watch 4": "images/watch4.jpeg",
      "Tshirt 1": "images/tshirt1.jpeg",
      "Tshirt 2": "images/tshirt2.jpeg",
      "Tshirt 3": "images/tshirt3.jpeg",
    };
  }

  function getProductDescription() {
    return {
      "Shoes 1":
        "Engineered for optimal performance, the NimbusFit Pro combines cutting-edge technology with sleek design.",
      "Shoes 2":
        "Designed for comfort and style, the AirFlex 2000 is perfect for your active lifestyle.",
      "Shoes 3":
        "A delightful blend of Mediterranean flavors, topped with fresh vegetables and feta cheese.",
      "Shoes 4":
        "StreetFlex Casuals redefine urban style with their effortlessly cool design..",
      "Bag 1":
        "StreetFlex Casuals redefine urban style with their effortlessly cool design..",
      "Bag 2":
        "The TrailBlaze Adventures Duffel Backpack is engineered for the intrepid explorer.",
      "Bag 3":
        "Elevate your professional image with the Prestige Executive Collection Leather Briefcase. Meticulously crafted from genuine leather, this briefcase exudes sophistication.",
      "Bag 4":
        "Embrace a relaxed yet stylish look with the UrbanCanvas Co. Casual Canvas Tote Bag.",
      "Watch 1":
        "Embrace a relaxed yet stylish look with the UrbanCanvas Co. Casual Canvas Tote Bag.",
      "Watch 2":
        "Embrace a relaxed yet stylish look with the UrbanCanvas Co. Casual Canvas Tote Bag.",
      "Watch 3":
        "Embrace a relaxed yet stylish look with the UrbanCanvas Co. Casual Canvas Tote Bag.",
      "Watch 4":
        "Embrace a relaxed yet stylish look with the UrbanCanvas Co. Casual Canvas Tote Bag.",
      "Tshirt 1":
        "Elevate your casual wardrobe with our premium quality cotton T-shirts.",
      "Tshirt 2":
        "Embrace a relaxed yet stylish look with the UrbanCanvas Co. Casual Canvas Tote Bag.",
      "Tshirt 3":
        "Embrace a relaxed yet stylish look with the UrbanCanvas Co. Casual Canvas Tote Bag.",
    };
  }

  function getProductPrice(productName) {
    const prices = {
      "Shoes 1": 89.99,
      "Shoes 2": 79.99,
      "Shoes 3": 99.99,
      "Shoes 4": 69.99,
      "Bag 1": 49.99,
      "Bag 2": 39.99,
      "Bag 3": 59.99,
      "Bag 4": 29.99,
      "Watch 1": 119.99,
      "Watch 2": 99.99,
      "Watch 3": 139.99,
      "Watch 4": 89.99,
      "Tshirt 1": 19.99,
      "Tshirt 2": 29.99,
      "Tshirt 3": 24.99,
    };
    return prices[productName] || 0;
  }

  function getProductDiscount() {
    return {
      "Shoes 1": "10% Off",
      "Shoes 2": "20% Off",
      "Shoes 3": "15% Off",
      "Shoes 4": "30% Off",
      "Bag 1": "5% Off",
      "Bag 2": "No Discount",
      "Bag 3": "10% Off",
      "Bag 4": "15% Off",
      "Watch 1": "No Discount",
      "Watch 2": "5% Off",
      "Watch 3": "No Discount",
      "Watch 4": "No Discount",
      "Tshirt 1": "15% Off",
      "Tshirt 2": "20% Off",
      "Tshirt 3": "10% Off",
    };
  }

  displayCartItems();
  updateCartCount();
});
