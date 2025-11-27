

    const destino = document.getElementById("des").textContent
    document.getElementById("Form").addEventListener("submit", function(event){
    event.preventDefault();
    const msg =document.getElementById('msg')

    const formdata = new FormData(this);
    console.log(destino)
    fetch(destino, {
        method:'POST',
        body: formdata
    })
    .then(res => res.text())
    .then(data => {
        msg.classList.add("alert", "alert-success")
        msg.style.transform = `translateY(-250px)`
        document.getElementById('msg').innerHTML = data;
        document.getElementById("Form").reset();
    });
});