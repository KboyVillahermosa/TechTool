document.addEventListener('DOMContentLoaded', () => {
  const cartItemsContainer = document.getElementById('cartItems');
  const productImages = getProductImages();

  function displayCartItems() {
    while (cartItemsContainer.firstChild) {
      cartItemsContainer.firstChild.remove();
    }

    let totalAmount = 0;

    for (let i = 0; i < localStorage.length; i++) {
      const key = localStorage.key(i);
      if (key && key.startsWith('product_')) {
        const productName = localStorage.getItem(key);
        const quantityKey = `quantity_${key}`;
        const productQuantity = parseInt(localStorage.getItem(quantityKey)) || 0;
        const cartItem = document.createElement('div');
        cartItem.classList.add('cartItem');

        const image = document.createElement('img');
        image.src = productImages[productName];
        image.alt = productName;
        image.classList.add('productImage');

        const itemName = document.createElement('span');
        itemName.textContent = productName;

        const quantity = document.createElement('span');
        const decreaseButton = document.createElement('button');
        decreaseButton.textContent = '-';
        decreaseButton.classList.add('quantityButton');
        decreaseButton.addEventListener('click', () => {
          updateQuantity(key, -1);
        });

        const increaseButton = document.createElement('button');
        increaseButton.textContent = '+';
        increaseButton.classList.add('quantityButton');
        increaseButton.addEventListener('click', () => {
          updateQuantity(key, 1);
        });

        quantity.appendChild(decreaseButton);
        quantity.appendChild(increaseButton);

        const amount = document.createElement('span');
        const productPrice = getProductPrice(productName);
        const productAmount = (productQuantity * productPrice).toFixed(2);
        amount.textContent = productAmount;

        totalAmount += parseFloat(productAmount);

        const removeButton = document.createElement('button');
        removeButton.textContent = 'Remove';
        removeButton.classList.add('removeButton');
        removeButton.addEventListener('click', () => {
          localStorage.removeItem(key);
          localStorage.removeItem(quantityKey);
          displayCartItems();
          updateCartCount();
        });

        cartItem.appendChild(image);
        cartItem.appendChild(itemName);
        cartItem.appendChild(quantity);
        cartItem.appendChild(amount);
        cartItem.appendChild(removeButton);
        cartItemsContainer.appendChild(cartItem);
      }
    }

    const totalAmountElement = document.getElementById('totalAmount');
    totalAmountElement.textContent = totalAmount.toFixed(2);
  }

  function updateQuantity(productcontentKey, quantityChange) {
    const quantityKey = `quantity_${productcontentKey}`;
    const currentQuantity = parseInt(localStorage.getItem(quantityKey)) || 0;
    const newQuantity = Math.max(currentQuantity + quantityChange, 0);
    localStorage.setItem(quantityKey, newQuantity.toString());
    displayCartItems();
    updateCartCount();
  }

  function updateCartCount() {
    const cartCount = document.getElementById('cartCount');
    if (cartCount) {
      let count = 0;
      for (let i = 0; i < localStorage.length; i++) {
        const key = localStorage.key(i);
        if (key && key.startsWith('product-content_')) {
          count++;
        }
      }
      cartCount.textContent = count.toString();
    }
  }

  function getProductImages() {
    return {
      'Margherita Pizza': 'images/sprite.jpg',
      'BBQ Chicken Pizza': 'images/bbq.jpg',
      'Mediterranean Pizza': 'images/Mediterranean Pizza.jpg',
      'Hawaiian Pizza': 'images/hawaiian.jpg',
      'Pepperoni & Mushroom Pizza': 'images/pepperoni.jpg',
      'Spinach and Feta Pizza': 'images/Spinach-Bacon.jpg',
      'Coke': 'images/coke.webp',
      'Sprite': 'images/sprite.jpg',
      'Royal': 'images/royal.jpg',
      'Mountain Dew': 'images/mountain.jpg',
      'Lava Cake': 'images/lava-cake.webp',
      'Mango Float': 'images/mango.jpg',
      'Tiramisu': 'images/tiramisu.wepb',
      'Apple Pie': 'images/apple-pie.jpg'
    };
  }

  function getProductPrice(productName) {
    const productPrices = {
      'Mediterranean Pizza': 225,
      'Hawaiian Pizza': 230,
      'Pepperoni & Mushroom Pizza': 280,
      'Spinach and Feta Pizza': 300,
      'Margherita': 200,
      'BBQ Chicken Pizza': 270,
      'Coke': 70,
      'Sprite': 75,
      'Royal': 78,
      'Mountain Dew': 80,
      'Lava Cake': 100,
      'Tiramisu': 130,
      'Apple Pie': 125,
      'Mango Float': 125
    };
    return productPrices[productName];
  }

  displayCartItems();
  updateCartCount();
});


