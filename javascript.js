
document.getElementById("Form").addEventListener("submit", function(event){
    event.preventDefault();

    const formdata = new FormData(this);

    fetch('inserts/insertanimal.php', {
        method:'POST',
        body: formdata
    })
    .then(res => res.text())
    .then(data => {
        document.getElementById('msg').innerHTML = data;
        document.getElementById("Form").reset();
    });
});