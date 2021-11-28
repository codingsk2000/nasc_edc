window.onload = () => {

    document.querySelector('.profile-btn').onclick = () => {
        document.querySelector('.profile-menu').classList.toggle('active');
    };

    // toggle btn 
    document.querySelector('.toggle-btn').onclick = () => {
        document.querySelector('.left-box').classList.toggle('active');
        document.querySelector('.right-box').classList.toggle('active');
    };

    //footer date
    document.querySelector('.footer-date').innerHTML = new Date().getFullYear();

    window.onscroll = () => {
        document.querySelector('.profile-menu').classList.remove('active');
    }

}