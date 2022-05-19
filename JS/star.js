const stars = document.querySelectorAll('.star');
let check = false ;
stars.forEach(star=>{
    star.addEventListener('mouseover',selectStars);
    star.addEventListener('mouseleave',unselectStars);
    star.addEventListener('click', activeSelect)

})

function selectStars(e){
    const data = e.target;
    const etoiles = priviousSiblings(data);
    if(!check){
    etoiles.forEach(etoile =>{
        etoile.classList.add('starhover');
    })}
}

function unselectStars(e){
    const data = e.target;
    const etoiles = priviousSiblings(data);
    if(!check){
    etoiles.forEach(etoile =>{
        etoile.classList.remove('starhover');
    })}
}

function activeSelect(e){
    check = true;
    document.querySelector('.note').innerHTML = 'Note : ' + e.target.dataset.note ;
}

function priviousSiblings(data){
    let values=[data];
    while(data=data.previousSibling){
        if(data.nodeName=='I'){
            values.push(data);
        }
    }
    return values
}