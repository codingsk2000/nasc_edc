window.onload = () => {

    const toggleBtn = document.querySelector('#btn-toggler');
    toggleBtn.addEventListener('click', () => {
        document.querySelector('#btn-toggler i').classList.toggle('fa-times');
        document.querySelector('.navbar').classList.toggle('active');
    });

    document.querySelectorAll('.navbar li').forEach((i) => {
        i.addEventListener('click', () => {
            document.querySelector('.navbar').classList.remove('active');
        });
    });

    window.onscroll = () => {
        document.querySelector('.navbar').classList.remove('active');
        document.querySelector('#btn-toggler i').classList.remove('fa-times');
    };
    // footer date
    document.querySelector('#footerDate').innerHTML = new Date().getFullYear();

    // department select code
    const dep = document.querySelector('#department');
    let course = document.querySelector('#course');
    dep.addEventListener('change', () => {
        const dep_id = dep.value;
        course.innerHTML = '';
        //http request
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "getdep.php",true);
        xhttp.setRequestHeader("Content-Type", "application/json");
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Response
                var response = this.responseText;
                response = JSON.parse(response);
                if (response.status == 0) {
                    var opt = document.createElement('option');
                    var text = document.createTextNode(response.msg);
                    var attr = document.createAttribute('disabled');
                    attr = document.createAttribute('selected');
                    attr = document.createAttribute('value');
                    opt.setAttributeNode(attr);
                    opt.appendChild(text);
                    course.appendChild(opt);
                } else {
                    response.forEach((e) => {
                        var opt = document.createElement('option');
                        var text = document.createTextNode(e.name);
                        var attr = document.createAttribute('value');
                        attr.value = e.id;
                        opt.setAttributeNode(attr);
                        opt.appendChild(text);
                        course.appendChild(opt);
                    });
                }
                
            }
        };
        var data = { dep_id: dep_id };
        xhttp.send(JSON.stringify(data));
    });

}



