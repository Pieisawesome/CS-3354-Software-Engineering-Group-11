window.addEventListener("load", () =>{
    // (A) GET ALL BOOKS
    var books = document.querySelectorAll(".bookWrap");
  
    // (B) ATTACH ONCLICK TO ALL BOOKS
    for (let book of books) {
      book.onclick = () => {
        // (B1) GET SELECTED BOOK ID, NAME, DESCRIPTION
        var id = book.dataset.id,
            name = book.querySelector(".bookTitle").innerHTML,
            desc = book.querySelector(".bookDesc").innerHTML;
  
        // (B2) SHOW IN DIALOG BOX
        alert(`You have selected - ID: ${id}, TITLE: ${name} DESC: ${desc}`);
      };
    }
  });