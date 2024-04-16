<template>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link to="/products" class="nav-link active" aria-current="page">Product</router-link>
            </li>
          </ul>
        </div>
        <!-- Affichage du panier -->
        <div class="nav-item">
          <router-link to="/api/cart" class="nav-link">Cart ({{ cart.length }})</router-link>
        </div>
      </div>
    </nav>
    <router-view/>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: "app",
  data() {
    return {
      cart: [] // Initialisez le tableau cart ici si nécessaire
    };
  },
  mounted() {
    this.fetchCart(); // Appel de la méthode fetchCart lors du montage du composant
  },
  methods: {
    async fetchCart() {
      try {
        // Effectuer une requête GET pour récupérer le contenu du panier depuis l'API Symfony
        const response = await axios.get('/api/cart');
        // Stocker le contenu du panier dans la variable cart
        this.cart = response.data;
      } catch (error) {
        console.error('Error fetching cart:', error);
      }
    }
  }
};
</script>
