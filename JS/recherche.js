function search() {
    let input = document.getElementById('barreDeRecherche').value;
    input=input.toLowerCase();
    alert (input);
    let x = document.getElementById()
      
    for (i = 0; i < x.length; i++) { 
        if (!x[i].innerHTML.toLowerCase().includes(input)) {
            x[i].style.display="none";
        }
        else {
            x[i].style.display="list-item";                 
        }
    }
}