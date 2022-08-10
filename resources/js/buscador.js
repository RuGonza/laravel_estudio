//javascript para el buscador
window.addEventListener("load",function() {
    document.getElementById("texto").addEventListener("keyup",function(){
        let table = document.getElementById("resultado"); 
        let searchText  = document.getElementById("texto").value.toLowerCase();
        let total = 0;
        //recorremos todas las filas del contenido de la tabla
        for (let i=0; i<table.rows.length; i++){
              // Si el td tiene la clase "noSearch" no se busca en su cntenido
              if (table.rows[i].classList.contains("noSearch")) {
                continue;
            }
            let found = false;
            const celdas = table.rows[i].getElementsByTagName('td');
             // Recorremos todas las celdas
             for (let j = 0; j < celdas.length && !found; j++) {
                const compareWith = celdas[j].innerHTML.toLowerCase();
                // Buscamos el texto en el contenido de la celda
                if (searchText.length == 0 || compareWith.indexOf(searchText) > -1) {
                    found = true;
                    total++;
                }
            }
            if(found){
                table.rows[i].style.display = "";
            }else {
                table.rows[i].style.display = "none";
            }
        }
          // mostramos las coincidencias
          const lastTR=table.rows[table.rows.length-1];
            const td=lastTR.querySelector("td");
            lastTR.classList.remove("hide", "red");
            console.log( lastTR.classList.remove("hide", "red"));
            if (searchText == "") {
                lastTR.classList.add("hide");
            } else if (total) {
                td.innerHTML="Se ha encontrado "+total+" coincidencia"+((total>1)?"s":"");
            } else {
                lastTR.classList.add("red");
                td.innerHTML="No se han encontrado coincidencias";
            }
        
        
    })
})

//modal de js
