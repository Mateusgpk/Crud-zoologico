

 const destino = document.getElementById("des").textContent
document.getElementById("Form").addEventListener("submit", function(event){
    event.preventDefault();
   
    const formdata = new FormData(this);
    console.log(destino)
    fetch(destino, {
        method:'POST',
        body: formdata
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById('msg').innerHTML = data;
        document.getElementById("Form").reset();
    });
});