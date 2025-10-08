<form action="" method="POST">
  <label>Correo electrónico:</label>
  <input type="email" name="correo" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
  <button type="submit">Enviar</button>
</form>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
if (filter_var($_POST['correo'], FILTER_VALIDATE_EMAIL)) {
    echo "Correo válido";
} else {
    echo "Correo inválido";
}
}
 ?>

 <form id="formularioDUI" method="POST">
   <label>DUI:</label>
   <input type="text" id="dui" name="dui" placeholder="00000000-0" required>
   <small id="mensaje"></small>
   <br><br>
   <button type="submit">Enviar</button>
 </form>

 <script>
   const inputDUI = document.getElementById('dui');
   const mensaje = document.getElementById('mensaje');

 //Expresión regular para DUI (8 dígitos, guion, 1 dígito)
  const regexDUI = /^\d{8}-\d{1}$/;
   // Validación en tiempo real
   inputDUI.addEventListener('input', () => {
    const valor = inputDUI.value;

    if (regexDUI.test(valor)) {
   mensaje.textContent = "DUI válido";
       mensaje.style.color = "green";
       inputDUI.style.border = "2px solid green";
     } else {
       mensaje.textContent = "Formato inválido. Ejemplo: 12345678-9";
       mensaje.style.color = "red";
       inputDUI.style.border = "2px solid red";
     }
   });

   document.getElementById('formularioDUI').addEventListener('submit', (e) => {
     if (!regexDUI.test(inputDUI.value)) {
       e.preventDefault();
       alert("Por favor, ingresa un DUI válido antes de enviar.");
     }
   });
 </script>
