
const getRandomInt = num => {
    return Math.floor(Math.random() * num);
}


let app = new Vue({
    el: '#app',
    created() {
        this.fetchBookData();
        this.fetchTableData();	
    }, 
    data: {
         isHidden: true
    },

    methods: {
        
        fetchTableData() {
            $.ajax({
                url: "./libs/php/viewAll.php",
                type: "POST",
                cache: false,
                success: function(result){
                    $('#table').html(result); 
                }
            });
        }, 
         


        fetchBookData(){
            $.ajax({
                url: './libs/php/getGoogleBooks.php',
                type: 'GET',
                data: {
                     category: $('#selCategory').val()
                },
                success: function(result) {
                    // get random int between 0(inclusive) and response length 
                    let randomInt = getRandomInt(result.data.length - 1);
                    let book = [];
                    //store result in var 
                    let books = result.data;

                    for( i = 0; i < books.length; i++) {
                        if (books.indexOf(books[i]) == randomInt){
                            book.push(books[i]);
                            break;
                        }
                    }
                    console.log(book);
                    //write values of randomly selected book to html
                    
                    $('#titleTxt').html(book[0].volumeInfo.title);
                    $('#descTxt').html(book[0].volumeInfo.description);
                    $('#authorNameTxt').html(book[0].volumeInfo.authors[0]);
                    $('#publisherNameTxt').html(book[0].volumeInfo.publisher);
                    $('#bookImg').html(`<a href="${book[0].volumeInfo.previewLink}" target="_blank"><img src="${book[0].volumeInfo.imageLinks.thumbnail}" alt="book cover"></a>`);

                },
                error: function(jqXHR, textStatus, errorThrown){
                    console.log(textStatus);
                }                 
           });
        },        
    }
});

