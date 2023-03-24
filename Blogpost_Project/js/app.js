(() => {
    console.log('App.js loaded')
    const like_btn = document.querySelector('#like-btn');
    const like_count = document.querySelector('#like-counter');
    let liked = false

    like_btn.addEventListener('click', () => {
        const like_count_value = parseInt(like_count.textContent);
        like_count.textContent = liked ? like_count_value - 1 : like_count_value + 1
        liked = !liked
    });

    const bookmark_btn = document.querySelector('#bookmark-btn');
    let marked = false
    bookmark_btn.addEventListener('click', () => {
        if (!marked) {
            document.querySelector('#bookmark-icon').style.fill = '#ECC20C'
            document.querySelector('#bookmark-icon').style.color = '#ECC20C'

        } else {
            document.querySelector('#bookmark-icon').style.color = 'white'
            document.querySelector('#bookmark-icon').style.fill = 'none'
        }
        marked = !marked
    });
})()