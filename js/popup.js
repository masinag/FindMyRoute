function show(ele, idForm){
    opener = ele;
    console.log(idForm);
    var lightbox = document.getElementById(idForm),
        dimmer = document.createElement("div");

    dimmer.style.width =  window.innerWidth + 'px';
    dimmer.style.height = window.innerHeight + 'px';
    dimmer.className = 'dimmer';

    dimmer.onclick = function(){
        document.body.removeChild(this);
        lightbox.style.visibility = 'hidden';
    }

    document.body.appendChild(dimmer);

    lightbox.style.visibility = 'visible';
    lightbox.style.top = window.innerHeight/2 - 50 + 'px';
    lightbox.style.left = window.innerWidth/2 - 100 + 'px';
    return false;
}
