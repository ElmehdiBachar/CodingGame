<template>
  <div class="container">
    <h1>Produits</h1>
    <div class="products">
      <div v-for="product in products" :key="product.id" class="product">
        <img :src="product.image" :alt="product.title" class="product-image">
        <h2>{{ product.title }}</h2>
        <p>{{ product.price }}</p>
        <button @click="addToCart(product.id)">Ajouter au panier</button>
        <button @click="showProductDetails(product)">Voir les détails</button>
        <!-- Affichage des détails du produit sélectionné -->
      </div>
      <div v-if="selectedProduct" class="product-details">
        <p>{{ selectedProduct.description }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      products: [],
      cart: [],
      selectedProduct: null
    };
  },
  mounted() {
    this.fetchProducts();
    this.fetchCart();
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await axios.get('/api/products');
        this.products = response.data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    },
    showProductDetails(product) {
    console.log(product);
      // Mettre à jour le produit sélectionné
      this.selectedProduct = product;
    },
    async addToCart(productId) {
        try {
            await axios.post(`/api/cart/add/${productId}`);
            this.fetchCart(); // Mettre à jour le panier après l'ajout
        } catch (error) {
            console.error('Error adding to cart:', error);
        }
    },
    async fetchCart() {
        try {
            const response = await axios.get('/api/cart');
            this.cart = response.data;
        } catch (error) {
            console.error('Error fetching cart:', error);
        }
    },
    getProductById(productId) {
        return this.products.find(product => product.id === productId) || {};
    }
  }
};
</script>

<style>
.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 20px;
}

.products {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  grid-gap: 20px;
}

.product {
  border: 1px solid #ccc;
  padding: 20px;
}

.product-image {
  max-width: 100%;
}

.cart {
  margin-top: 20px;
  border: 1px solid #ccc;
  padding: 10px;
}

.product-details {
  margin-top: 20px;
  border: 1px solid #ccc;
  padding: 20px;
}
</style>
