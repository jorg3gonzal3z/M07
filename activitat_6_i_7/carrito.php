<?php
session_start();
include("funcions.php");

if(isset($_SESSION["lista_productos"])){
    //print_r($_SESSION["lista_productos"]);
    //print_r($_SESSION["lista_precios"]);

    echo "<h1>Cesta de la compra</h1>";

    echo "<br>"."<br>"."-- Llistat de productes per comprar --"."<br>"."<br>";

    foreach($_SESSION["lista_productos"] as $id){

        mostrarCarrito($id);
        echo "<hr><br>";
        
    }

    echo"<h4>Preu Total</h4>";
    print_r($_SESSION["lista_precios"]);
    echo "€";
    

}else{
    echo"El carrito esta buit";
}
echo "<br><br>";
echo "<a href='privada.php'> [Torna ]</a>";
echo "<br><br>";
echo "<a href='deletecesta.php'> [Netejar Cesta ]</a><br><br>";
?>

 

<!DOCTYPE html>
<html>
  <head>
    <title>Buy cool new product</title>

    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <section>
      <button id="checkout-button">Checkout</button>
    </section>
  </body>
  <script type="text/javascript">
    // Create an instance of the Stripe object with your publishable API key
    var stripe = Stripe("pk_test_51HowCgCH8plbppBN8cCYljxNUp0A1QjCxnNd2vQvbMumswS106BeR7MXdzffQ8scpQfJfaD9pWdL4UUCjsLO0vcD00ZtqSXxS8");
    var checkoutButton = document.getElementById("checkout-button");

    checkoutButton.addEventListener("click", function () {
      fetch("create-session.php", {
        method: "POST",
      })
        .then(function (response) {
          return response.json();
        })
        .then(function (session) {
          return stripe.redirectToCheckout({ sessionId: session.id });
        })
        .then(function (result) {
          // If redirectToCheckout fails due to a browser or network
          // error, you should display the localized error message to your
          // customer using error.message.
          if (result.error) {
            alert(result.error.message);
          }
        })
        .catch(function (error) {
          console.error("Error:", error);
        });
    });
  </script>
</html>