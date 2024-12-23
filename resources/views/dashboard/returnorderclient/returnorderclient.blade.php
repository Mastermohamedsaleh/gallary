@extends('dashboard.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <div class="content-wrapper">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        #total-price {
            font-size: 20px;
            font-weight: bold;
            margin-top: 20px;
        }
    </style>

    
  
    
 




<section class="content">

<div class="box box-primary">

    <div class="box-header with-border">



    <div id="input-container box-header">
        <input type="text" id="qr-input" placeholder="Scan QR Code here" class="form-control" autofocus >
        <input type="text" id="name-input" placeholder="Search by Name" class="form-control" style="margin-top:20px">
        <button id="search-name-button" style="margin-top:20px">Search by Name</button>
    </div>
    <div id="error-message"></div>

   

   

   
    <table class="table table-hover text-center">
        <thead>
            <tr>
                <th>Code</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Actions</th>
              
            </tr>
        </thead>
        <tbody id="product-list"></tbody>
    </table>
   
    </div>
    </div>

    </section>



    <div class="box container" style="width:500px">
    <div class="box-body">
    <div id="total-price" class="text-center"  >Total Price: $0.00</div>
    <!-- <input id="total-price" type="number" value="0"> -->
    <button id="save-button">Save</button>
    </div>
    </div>




    <div id="profit" style="display:none">Total Profit: $0.00</div>


<script>
const qrInput = document.getElementById('qr-input');
const nameInput = document.getElementById('name-input');
const searchNameButton = document.getElementById('search-name-button');
const productList = document.getElementById('product-list');
const errorMessage = document.getElementById('error-message');
const totalPrice = document.getElementById('total-price');
const totalProfitElement = document.getElementById('profit'); // العنصر لعرض إجمالي الربح
const saveButton = document.getElementById('save-button');
let products = [];
let total = 0;
let totalProfit = 0; // الربح الإجمالي

// تحديث السعر الإجمالي الكلي
function updateTotalPrice() {
    total = products.reduce((sum, product) => sum + (product.sale_price * product.quantity), 0);
    totalPrice.textContent = `Total Price: $${total.toFixed(2)}`;
}

// تحديث إجمالي الربح
function updateTotalProfit() {
    totalProfit = products.reduce((sum, product) => 
        sum + ((product.sale_price - product.purchase_price) * product.quantity), 0);
    totalProfitElement.textContent = `Total Profit: $${totalProfit.toFixed(2)}`;
}

// تحديث الكمية عند تغييرها
function updateQuantity(barcode, quantity) {
    const product = products.find(p => p.barcode === barcode);
    if (!product) return;

    product.quantity = parseInt(quantity, 10) || 1;

    // تحديث إجمالي السعر لهذا المنتج
    document.getElementById(`total-${barcode}`).textContent = `$${(product.sale_price * product.quantity).toFixed(2)}`;
    
    // تحديث الإجمالي الكلي
    updateTotalPrice();
    // تحديث إجمالي الربح
    updateTotalProfit();
}

// حذف منتج من القائمة
function removeProduct(barcode) {
    products = products.filter(product => product.barcode !== barcode);
    document.getElementById(`row-${barcode}`).remove();
    updateTotalPrice();
    updateTotalProfit();
}

// إضافة منتج إلى الجدول عند البحث بالكود أو الاسم
async function addProductByCodeOrName(type, value) {
    try {
        const response = await axios.post(`/fetch-product-${type}`, { [type]: value });
        const product = response.data.product;

        // التحقق إذا كان المنتج موجود بالفعل
        const existingProduct = products.find(p => p.barcode === product.barcode);
        if (existingProduct) {
            errorMessage.textContent = 'Product already added. Adjust quantity if needed.';
        } else {
            // إضافة المنتج الجديد
            products.push({ ...product, quantity: 1 });

            const row = document.createElement('tr');
            row.id = `row-${product.barcode}`;
            row.innerHTML = `
                <td>${product.barcode}</td>
                <td>${product.name}</td>
                <td>$${product.sale_price.toFixed(2)}</td>
                <td>
                    <input type="number" id="quantity-${product.barcode}" value="1" min="1" style="width: 60px;"
                        onchange="updateQuantity('${product.barcode}', this.value)">
                </td>
                <td id="total-${product.barcode}">$${product.sale_price.toFixed(2)}</td>
                <td><button onclick="removeProduct('${product.barcode}')">Remove</button></td>
            `;
            productList.appendChild(row);
        }

        // تحديث الإجمالي الكلي
        updateTotalPrice();
        // تحديث إجمالي الربح
        updateTotalProfit();

        // تنظيف الحقول
        qrInput.value = '';
        nameInput.value = '';
        errorMessage.textContent = '';
    } catch (err) {
        errorMessage.textContent = err.response?.data?.message || 'Error fetching product.';
    }
}

// البحث بالكود
qrInput.addEventListener('input', () => {
    const code = qrInput.value.trim();
    if (code) addProductByCodeOrName('code', code);
});

// البحث بالاسم عند النقر على الزر
searchNameButton.addEventListener('click', () => {
    const name = nameInput.value.trim();
    if (name) addProductByCodeOrName('name', name);
});

// حفظ البيانات في قاعدة البيانات
saveButton.addEventListener('click', async () => {
    const totalPriceElement = document.getElementById('total-price');
    const totalPriceText = totalPriceElement.textContent || "Total Price: $0.00"; // توفير قيمة افتراضية
    const totalPriceValue = parseFloat(totalPriceText.replace(/[^0-9.]/g, '')) || 0;

    try {
        const response = await axios.post('/savereturnorder', { products, totalPrice: totalPriceValue, totalProfit });

        alert(response.data.message || 'Order saved successfully!');
        products = [];
        productList.innerHTML = '';
        updateTotalPrice();
        updateTotalProfit();
    } catch (err) {
        errorMessage.textContent = err.response?.data?.message || 'Error saving order.';
    }
});

// تعريف الدوال لتكون متاحة في HTML
window.updateQuantity = updateQuantity;
window.removeProduct = removeProduct;
</script>
    </div>

@endsection