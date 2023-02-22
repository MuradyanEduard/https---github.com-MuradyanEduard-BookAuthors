<template>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light" style="max-height:100px!important">
  <!-- Container wrapper -->
  <div class="container-fluid">
    <!-- Collapsible wrapper -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <!-- Left links -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <a class="nav-link" href="/book">Books </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/book/create">Create Book</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/author">Authors </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/author/create">Create Authors </a>
        </li>
      </ul>
      <!-- Left links -->
    </div>
    <!-- Collapsible wrapper -->

    <!-- Right elements -->
    <div class="d-flex align-items-center">
        <form class="form-inline my-2 my-lg-0">
            <input class=" my-2 my-sm-0" type="search" style="margin:auto 10px"  placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>
    <!-- Right elements -->
  </div>
  <!-- Container wrapper -->
</nav>
<!-- Navbar -->

</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped>
.btn-close {
  background-color: red;
}
</style>