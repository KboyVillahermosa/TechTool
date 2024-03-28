document.addEventListener('DOMContentLoaded', () => {
  const cartItemsContainer = document.getElementById('cartItems');
  const productImages = getProductImages(); // Retrieve the product images

  // Loop through the stored products and display them
  for (let i = 1; i <= localStorage.length; i++) {
    const key = localStorage.key(i);
    if (key && key.startsWith('product_')) {
      const productName = localStorage.getItem(key);
      const cartItem = document.createElement('div');
      cartItem.classList.add('cartItem');

      const image = document.createElement('img');
      image.src = productImages[productName]; // Set the image source based on the product name
      image.alt = productName;

      const itemName = document.createElement('span');
      itemName.textContent = productName;

      const quantity = document.createElement('span');
      const decreaseButton = document.createElement('button');
      decreaseButton.textContent = '-';
      decreaseButton.addEventListener('click', () => {
        // Decrease the quantity of the selected product
        updateQuantity(key, -1);
      });

      const increaseButton = document.createElement('button');
      increaseButton.textContent = '+';
      increaseButton.addEventListener('click', () => {
        // Increase the quantity of the selected product
        updateQuantity(key, 1);
      });

      quantity.appendChild(decreaseButton);
      quantity.appendChild(increaseButton);

      const amount = document.createElement('span');
      amount.textContent = calculateProductAmount(key);

      const removeButton = document.createElement('button');
      removeButton.textContent = 'Remove';
      removeButton.addEventListener('click', () => {
        // Remove the selected product from the local storage
        localStorage.removeItem(key);
        // Refresh the cart items and update cart count
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

  // Calculate and display the total amount for all products
  const totalAmount = calculateTotalAmount();
  const totalAmountElement = document.createElement('div');
  totalAmountElement.classList.add('totalAmount');
  totalAmountElement.textContent = `Total Amount: $${totalAmount.toFixed(2)}`;
  cartItemsContainer.appendChild(totalAmountElement);
});

// Function to update the quantity of a product
function updateQuantity(key, change) {
  const quantityKey = `quantity_${key}`;
  let productQuantity = parseInt(localStorage.getItem(quantityKey)) || 0;

  // Update the quantity
  productQuantity += change;

  if (productQuantity <= 0) {
    // If the quantity is zero or negative, remove the product from the cart
    localStorage.removeItem(key);
    localStorage.removeItem(quantityKey);
  } else {
    // Update the quantity in the local storage
    localStorage.setItem(quantityKey, productQuantity);
  }

  // Refresh the cart items and update cart count
  displayCartItems();
  updateCartCount();
}

// Function to calculate the total amount for a product
function calculateProductAmount(key) {
  const quantityKey = `quantity_${key}`;
  const productQuantity = parseInt(localStorage.getItem(quantityKey)) || 0;
  // You can replace the placeholder price with the actual price for the product
  const productPrice = 10; // Replace with the actual price for the product
  const totalAmount = productQuantity * productPrice;
  return `$${totalAmount.toFixed(2)}`;
}

// Function to calculate the total amount for all products
function calculateTotalAmount() {
  let totalAmount = 0;

  for (let i = 1; i <= localStorage.length; i++) {
    const key = localStorage.key(i);
    if (key && key.startsWith('product_')) {
      const quantityKey = `quantity_${key}`;
      const productQuantity = parseInt(localStorage.getItem(quantityKey)) || 0;
      // You can replace the placeholder price with the actual price for each product
      const productPrice = 10; // Replace with the actual price for the product
      const productAmount = productQuantity * productPrice;
      totalAmount += productAmount;
    }
  }

  return totalAmount;
}

// Function to refresh the cart items display
function displayCartItems() {
  const cartItemsContainer = document.getElementById('cartItems');
  cartItemsContainer.innerHTML = ''; // Clear the container

  const productImages = getProductImages(); // Retrieve the product images

  // Loop through the stored products and display them
  for (let i = 1; i <= localStorage.length; i++) {
    const key = localStorage.key(i);
    if (key && key.startsWith('product_')) {
      const productName = localStorage.getItem(key);
      const cartItem = document.createElement('div');
      cartItem.classList.add('cartItem');

      const image = document.createElement('img');
      image.src = productImages[productName]; // Set the image source based on the product name
      image.alt = productName;

      const itemName = document.createElement('span');
      itemName.textContent = productName;

      const quantity = document.createElement('span');
      const decreaseButton = document.createElement('button');
      decreaseButton.textContent = '-';
      decreaseButton.addEventListener('click', () => {
        // Decrease the quantity of the selected product
        updateQuantity(key, -1);
      });

      const increaseButton = document.createElement('button');
      increaseButton.textContent = '+';
      increaseButton.addEventListener('click', () => {
        // Increase the quantity of the selected product
        updateQuantity(key, 1);
      });

      quantity.appendChild(decreaseButton);
      quantity.appendChild(increaseButton);

      const amount = document.createElement('span');
      amount.textContent = calculateProductAmount(key);

      const removeButton = document.createElement('button');
      removeButton.textContent = 'Remove';
      removeButton.addEventListener('click', () => {
        localStorage.removeItem(key);
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

  // Calculate and display the total amount
  const totalAmount = calculateTotalAmount();
  const totalAmountElement = document.createElement('div');  
  totalAmountElement.classList.add('totalAmount');
  totalAmountElement.textContent = `Total Amount: $${totalAmount.toFixed(2)}`;
  cartItemsContainer.appendChild(totalAmountElement);
}

// Function to update the cart count display
function updateCartCount() {
  const cartCount = localStorage.length - 1; // Subtract 1 to exclude 'cartCount' item
  document.getElementById('cartButton').textContent = ` (${cartCount})`;
}

// Clear the cart count in local storage on page load
document.addEventListener('DOMContentLoaded', () => {
  localStorage.removeItem('cartCount');
});

// Get the "Add to Cart" buttons
const addToCartButtons = document.querySelectorAll('.addToCart');

// Add click event listener to each "Add to Cart" button
addToCartButtons.forEach(button => {
  button.addEventListener('click', addToCart);
});

// Function to handle adding items to the cart
function addToCart() {
  // Get the current cart count
  let cartCount = parseInt(localStorage.getItem('cartCount')) || 0;

  // Get the product details
  const productName = this.parentNode.querySelector('h3').textContent;

  // Check if the product is already in the cart
  let existingProductKey = '';
  let existingProductQuantity = 0;

  for (let i = 1; i <= cartCount; i++) {
    const key = `product_${i}`;
    const storedProductName = localStorage.getItem(key);
    if (storedProductName === productName) {
      existingProductKey = key;
      existingProductQuantity = parseInt(localStorage.getItem(`quantity_${key}`)) || 0;
      break;
    }
  }

  if (existingProductKey) {
    // Product is already in the cart, update the quantity
    existingProductQuantity++;
    localStorage.setItem(`quantity_${existingProductKey}`, existingProductQuantity);
  } else {
    // Increment the cart count
    cartCount++;

    // Update the cart count in the local storage
    localStorage.setItem('cartCount', cartCount);

    // Update the cart button text
    document.getElementById('cartButton').textContent = ` (${cartCount})`;

    // Store the selected product in the local storage
    const key = `product_${cartCount}`;
    localStorage.setItem(key, productName);
    localStorage.setItem(`quantity_${key}`, 1);
  }

  // Refresh the cart items and update cart count
  displayCartItems();
  updateCartCount();
}

function changeCategory(category) {
  // Hide all product containers
  var productContainers = document.getElementsByClassName('product-container');
  for (var i = 0; i < productContainers.length; i++) {
      productContainers[i].classList.remove('active');
  }

  // Show selected category
  var selectedCategory = document.getElementById(category);
  selectedCategory.classList.add('active');
}

const navbarToggler = document.querySelector('.navbar-toggler');
const closeNavButton = document.getElementById('closeNavButton');
const navbarNav = document.getElementById('navbarNav');

navbarToggler.addEventListener('click', function() {
  navbarNav.classList.toggle('show');
  closeNavButton.classList.toggle('d-none');
});

closeNavButton.addEventListener('click', function() {
  navbarNav.classList.remove('show');
  closeNavButton.classList.add('d-none');
});








//add to cart modal
function addToCart() {
  // Get the current cart count
  let cartCount = parseInt(localStorage.getItem('cartCount')) || 0;
  const productName = this.parentNode.querySelector('h3').textContent;

  // Check if the product is already in the cart
  let existingProductKey = '';
  let existingProductQuantity = 0;

  for (let i = 1; i <= cartCount; i++) {
    const key = `product_${i}`;
    const storedProductName = localStorage.getItem(key);
    if (storedProductName === productName) {
      existingProductKey = key;
      existingProductQuantity = parseInt(localStorage.getItem(`quantity_${key}`)) || 0;
      break;
    }
  }

  if (existingProductKey) {
    // Product is already in the cart, update the quantity
    existingProductQuantity++;
    localStorage.setItem(`quantity_${existingProductKey}`, existingProductQuantity);
  } else {
    // Increment the cart count
    cartCount++;

    // Update the cart count in the local storage
    localStorage.setItem('cartCount', cartCount);

    // Update the cart button text
    document.getElementById('cartButton').textContent = ` (${cartCount})`;

    // Store the selected product in the local storage
    const key = `product_${cartCount}`;
    localStorage.setItem(key, productName);
    localStorage.setItem(`quantity_${key}`, 1);

    // Display the modal notification
    displayNotification(`${productName} added to cart!`);
  }

  // Refresh the cart items and update cart count
  displayCartItems();
  updateCartCount();
}

function displayNotification(message) {
  const modalOverlay = document.getElementById('modalOverlay');
  const notificationModal = document.getElementById('notificationModal');
  const notificationContent = document.getElementById('notificationContent');

  // Set the notification content with the icon
  notificationContent.innerHTML = `<i class="fa-solid fa-check"></i> ${message}`;

  // Display the modal
  modalOverlay.style.display = 'flex';
  setTimeout(() => {
    modalOverlay.style.display = 'none';
  }, 500);
}



