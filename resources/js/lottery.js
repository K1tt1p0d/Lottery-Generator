const generateBtn = document.querySelector('#generateBtn');
const input = {
    first_prize:  document.querySelector('#first_prize'),
    second_prize_st:  document.querySelector('#second_prize_st'),
    second_prize_nd:  document.querySelector('#second_prize_nd'),
    second_prize_rd:  document.querySelector('#second_prize_rd'),
    similar_first_prize_more: document.querySelector('#similar_first_prize_more'),
    similar_first_prize_less: document.querySelector('#similar_first_prize_less'),
    two_digit_prize:  document.querySelector('#two_digit_prize'),
    check_prize: document.querySelector('#check_prize'),
};

generateBtn.onclick = () => {
    generateBtn.setAttribute('disabled', 'disabled');
    window.axios.get('generate').then((response)=> {
        let data = response.data;
        show('#randomNumbers');
        input.first_prize.innerHTML = data.first_prize;
        input.second_prize_st.innerHTML = data.second_prize_st;
        input.second_prize_nd.innerHTML = data.second_prize_nd;
        input.second_prize_rd.innerHTML  = data.second_prize_rd;
        input.similar_first_prize_more.innerHTML  = data.similar_first_prize_more;
        input.similar_first_prize_less.innerHTML  = data.similar_first_prize_less;
        input.two_digit_prize.innerHTML  = data.two_digit_prize;
        generateBtn.removeAttribute('disabled');
    }, (errors) => {
        console.log(errors);
        generateBtn.removeAttribute('disabled');   
        window.swal(errors.response.data.message);
    });
}

const confirmBtn = document.querySelector('#confirmBtn');

confirmBtn.onclick = () => {
    let formData = {
        first_prize: input.first_prize.innerHTML,
        second_prize_st: input.second_prize_st.innerHTML,
        second_prize_nd: input.second_prize_nd.innerHTML,
        second_prize_rd: input.second_prize_rd.innerHTML,
        similar_first_prize_more: input.similar_first_prize_more.innerHTML,
        similar_first_prize_less: input.similar_first_prize_less.innerHTML,
        two_digit_prize: input.two_digit_prize.innerHTML,
        check_prize: input.check_prize.value,
    };

    confirmBtn.setAttribute('disabled', 'disabled');
    window.axios.post('submit', formData).then((response) => {
        let data = response.data;
        confirmBtn.removeAttribute('disabled');
        window.swal(data.title, data.message, data.result);
    }, (errors) => {
        confirmBtn.removeAttribute('disabled');
        window.swal(errors.response.data.message);
    });
}

show = (element) => {
    document.querySelector(element).classList.remove('d-none');
}