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


}



