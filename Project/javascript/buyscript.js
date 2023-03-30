function attachBuyEvents() {

    for (const button of document.getElementsByClassName('orderbutton'))
      button.addEventListener('click', function(e) {
        const article = this.parentElement
  
        const id = article.getAttribute('data-id')
        const row = document.querySelector(`#cart table tr[data-id="${id}"]`)
  
        const name = article.querySelector('.dishname').textContent
        const price = article.querySelector('.price').textContent
        const quantity = article.querySelector('.quantity').value
  
        if (row) updateRow(row, price, quantity)
        else addRow(id, name, price, quantity)
  
        updateTotal()
      })
  }
  
  function addRow(id, name, price, quantity) {
    const table = document.querySelector('#cart table')
    const row = document.createElement('tr')
    row.setAttribute('data-id', id)
  
    const idCell = document.createElement('td')
    idCell.classList.add('iddish')
    idCell.textContent = id
  
    const nameCell = document.createElement('td')
    nameCell.classList.add('namedish')
    nameCell.textContent = name
  
    const quantityCell = document.createElement('td')
    quantityCell.classList.add('quantitydish')
    quantityCell.textContent = quantity
  
    const priceCell = document.createElement('td')
    priceCell.classList.add('pricedish')
    priceCell.textContent = price
  
    const totalCell = document.createElement('td')
    totalCell.classList.add('totalcelldish')
    totalCell.textContent = (price * quantity).toFixed(2)
  
    const deleteCell = document.createElement('td')
    deleteCell.classList.add('delete')
    deleteCell.innerHTML = '<a href="">X</a>'
    deleteCell.querySelector('a').addEventListener('click', function(e) {
      e.preventDefault()
      e.currentTarget.parentElement.parentElement.remove()
      updateTotal()
    })
  
    row.appendChild(idCell)
    row.appendChild(nameCell)
    row.appendChild(quantityCell)
    row.appendChild(priceCell)
    row.appendChild(totalCell)
    row.appendChild(deleteCell)
  
    table.appendChild(row)
  }
  
  function updateRow(row, price, quantity) {
    const quantityCell = row.querySelector('td:nth-child(3)')
    const totalCell = row.querySelector('td:nth-child(5)')
    
    quantityCell.textContent = (parseInt(quantityCell.textContent, 10) + parseInt(quantity, 10))
    totalCell.textContent = (parseFloat(quantityCell.textContent, 10) * parseFloat(price, 10)).toFixed(2)
  }
  
  function updateTotal() {
    const rows = document.querySelectorAll('#cart table > tr')
    const values = [...rows].map(r => parseFloat(r.querySelector('td:nth-child(5)').textContent, 10)) 
    const total = values.reduce((t, v) => t + v, 0)
    document.querySelector('#cart table tfoot th:last-child').textContent = total.toFixed(2)
  }

  function SaveItems() {
    localStorage.clear()
    var table = document.getElementById("carttable");
    var counter = 0
    var counter2 = 0
    
    for (let i in table.rows) {
      let row = table.rows[i]
      counter2 = 0;
      if(counter == 0)
      {
        counter = counter + 1
        continue

      }
      var nome
      //iterate through rows
      //rows would be accessed using the "row" variable assigned in the for loop
      for (let j in row.cells) {
        let col = row.cells[j]
        
        if(counter2 == 0)
        {
          nome = col.innerText
          console.log("primeiro atributo")
          console.log(nome)
        }
        if(counter2 == 2)
        {
          console.log("segundo atributo")
          console.log(col.innerText)
          if(col.innerText == undefined)
          {
            break
          }
          localStorage.setItem(String(nome),String(col.innerText))
          break
        }
        
        //iterate through columns
        //columns would be accessed using the "col" variable assigned in the for loop
        counter2 = counter2 + 1
      }  
   }
    for (i = 0; i < localStorage.length; i++) {
     key = localStorage.key(i);
     item = localStorage.getItem(key);
     /*
     console.log(localStorage.key(i))
     console.log(localStorage.getItem(key));
     */
     const request = new XMLHttpRequest();
     request.open("get","../pages/storeorder.php?" + encodeForAjax({id:String(key) ,di:String(item)}),false);
     request.send();
      
     
    }
    window.location.replace("../pages/checkout.php");
    
  }
  function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&')
  }
  function CheckBrowser() {
    if ('localStorage' in window && window['localStorage'] !== null) {
      // we can use localStorage object to store data
      return true;
    } else {
        return false;
    }
  }
  attachBuyEvents()