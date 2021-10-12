@extends('layout.app')

@section('content')
    cust prod
    <div class="container-xxl border">
        <div class="row justify-content-center">
            <div class="d-none d-md-grid col-2 bg-info bg-opacity-10">
                <div class="nav flex-column nav-pills me-3" id="vPillsTab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link" id="vPillsAddressTab" data-bs-toggle="pill" data-bs-target="#vPillsAddress" type="button" role="tab" aria-selected="true">All</button>
                    <button class="nav-link" id="vPillsOrdersTab" data-bs-toggle="pill" data-bs-target="#vPillsOrders" type="button" role="tab" aria-selected="false">Orders</button>
                </div>
            </div>
            <div class="d-grid d-md-none bg-info">
                <div class="nav flex-column nav-pills me-3" id="v-pills-tab-mo" role="tablist" aria-orientation="vertical">
                    hi
                </div>
            </div>
            <div class="tab-content col-12 col-md-10 bg-secondary bg-opacity-10" id="tabContent">
                <div class="tab-pane fade show active" id="vPillsAddress" role="tabpanel">
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart" id="shopnCartBtn">View Cart</button>

                    <select id="selNum" class="form-select" aria-label="Select number of record per page">
                        <option value="0" selected>Select</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>

                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4" id="prodList"></div>
                    <div id="ppCon"></div>
                </div>
                <div class="tab-pane fade" id="vPillsOrders" role="tabpanel">
                    orders
                </div>
            </div>
        </div>
    </div>

    <div id="ppCon"></div>

  <!-- Modal -->
  <div class="modal fade" id="staticQikView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticQikView" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen-lg-down modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticQikView">Product Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="row row-cols-1 row-cols-md-2" id="prodDet">
                <div class="col col-md-6 bg-warning" id="leftPnl">
                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-indicators">
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner bg-secondary" id="crselInr"></div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                        </button>
                      </div>
                </div>
                <div class="col col-md-6 bg-secondary bg-opacity-10" id="rightPnl">
                    <div id="prodSpec"></div>
                    <form action="{{ route('cart.store') }}" method="POST" enctype="multipart/form-data" id="prodForm">
                        @csrf
                        <input type="hidden" name="prodUsr" id="prodUsr" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="prodRef" id="prodRef">
                        <div class="row row-cols-1 row-cols-sm-2">
                            <div class="col">
                                <div class="row row-cols-1 row-cols-sm-2">
                                    <div class="col col-sm-2 align-self-end">
                                        <label for="prodQty" class="form-label">Qty: </label>
                                    </div>
                                    <div class="col col-sm-10">
                                        <input class="form-control" type="number" min="1" name="prodQty" id="prodQty" value="1">
                                    </div>
                                </div>
                            </div>
                            <div class="col mt-2 mt-sm-0">
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                          <button class="nav-link active" id="nav-description-tab" data-bs-toggle="tab" data-bs-target="#nav-description" type="button" role="tab" aria-controls="nav-description" aria-selected="true">Description</button>
                          <button class="nav-link" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" type="button" role="tab" aria-controls="nav-about" aria-selected="false">About</button>
                          <button class="nav-link" id="nav-faq-tab" data-bs-toggle="tab" data-bs-target="#nav-faq" type="button" role="tab" aria-controls="nav-faq" aria-selected="false">F.A.Q.</button>
                        </div>
                      </nav>
                      <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-description" role="tabpanel" aria-labelledby="nav-description-tab">
                            homeeee
                        </div>
                        <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                            2nddddd
                        </div>
                        <div class="tab-pane fade" id="nav-faq" role="tabpanel" aria-labelledby="nav-faq-tab">
                            3rdddddddddd
                        </div>
                      </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">

                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

    <div class="offcanvas offcanvas-end" data-bs-scroll="false" data-bs-backdrop="true" data-bs-keyboard="false" tabindex="-1" id="offcanvasCart" aria-labelledby="offcanvasCartLabel" style="width: 500px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasCartLabel">Shopping Cart</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-group list-group-flush" id="shopnCart">
            <li class="list-group-item">
                <div class="row justify-content-center align-items-center align-items-sm-stretch">
                    <div class="col-12 col-sm-9 align-self-sm-center">
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <img src="https://files.worldwildlife.org/wwfcmsprod/images/Panda_in_Tree/hero_small/99i33zyc0l_Large_WW170579.jpg" style="object-fit: cover; width: 100px; height: 100px;" alt="">
                            </div>
                            <div class="col">
                                <div class="d-flex flex-column justify-content-between">
                                    <div class="d-flex flex-column">
                                        <span>Product name here</span>
                                        <span>ss here</span>
                                    </div>
                                    <span class="text-secondary lh-lg">Qty:</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 align-self-center">
                        <div class="d-flex flex-wrap align-items-center justify-content-between p-2 flex-row-reverse flex-sm-nowrap flex-sm-column">
                            <span class="text-secondary">Amount</span>
                            <span class="text-danger mt-0 mt-sm-5">Remove</span>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
    </div>
<script>
    window.addEventListener('load', custProd);

    function custProd()
    {
        const shopnCartBtn = document.getElementById('shopnCartBtn');

        if (shopnCartBtn)
        {
            shopnCartBtn.addEventListener('click', shopnCart);
        }

        getProd(1, 5);
    }

    function getProd(minRec, maxRec)
    {
        axios.get('/shop/products/all')

        .then (response => {
            const prodGet = response.data;

            console.log('prod: ', prodGet.test);

            genBtn(prodGet, minRec, maxRec);
            chunkRec(prodGet, minRec, maxRec);
        })

        .catch (error => {
            console.log('err: ', error);
        });
    }

    function genBtn(list, startIdx, len)
    {
        let ppNum = 1;
        const ppCon = document.getElementById('ppCon');
        ppCon.innerHTML = '';

        const pNumCon = document.createElement('div');
        pNumCon.classList.add('btn-group');
        pNumCon.setAttribute('role', 'group');
        pNumCon.setAttribute('aria-label', 'List of page buttons');

        if (list.prod.length > 1) {
            ppNum = Math.ceil(list.prod.length / len);

            // if (ppNum < 6) {
                for (let i = 1; i <= ppNum; i++) {
                    const pNumBtn = document.createElement('button');
                    pNumBtn.type = 'button';
                    pNumBtn.dataset.page = i;
                    pNumBtn.classList.add('btn', 'btn-primary');
                    pNumBtn.innerHTML = i;

                    pNumBtn.addEventListener('click', func => {
                        chunkRec(list, parseInt(func.target.dataset.page), len);
                    });

                    pNumCon.appendChild(pNumBtn);
                }

                ppCon.appendChild(pNumCon);
            // }
        }
    }

    function chunkRec(list, currPage, chunkLen)
    {
        let chunkGet = null;
        const prodList = document.getElementById('prodList');
        prodList.innerHTML = '';
        let ctr = ((chunkLen * currPage) - chunkLen) + 1;
        let imgCtr = 1;

        if (list.prod.length > chunkLen || list.prod.length < chunkLen) {
            chunkGet = list.prod.slice((chunkLen * currPage) - chunkLen, (chunkLen * currPage));
        } else if (list.prod.length == chunkLen) {
            chunkGet = list.prod.slice((chunkLen * currPage) - chunkLen);
        }

        console.log(chunkGet);

        for (let i = 0; i < chunkGet.length; i++) {
            // console.log('ref: ', chunkGet[i]);

            const prodWrapper = document.createElement('div');
            prodWrapper.classList.add('col');
            prodWrapper.id = 'prod' + (i + 1);
            const cardCon = document.createElement('div');
            cardCon.classList.add('card', 'h-100');
            const cardImg = document.createElement('img');
            cardImg.classList.add('card-img-top');
            const cardBody = document.createElement('div');
            cardBody.classList.add('card-body');
            const cardDet = document.createElement('div');
            cardDet.classList.add('row');
            const cardTit = document.createElement('div');
            cardTit.classList.add('col-12', 'col-xl-8', 'card-title', 'fs-5', 'me-auto');
            const cardPr = document.createElement('div');
            cardPr.classList.add('col-12', 'col-xl-4', 'card-title', 'fs-5');
            const cardStk = document.createElement('div');
            cardStk.classList.add('col');
            const cardBtn = document.createElement('button');

            cardTit.innerHTML = chunkGet[i].name;
            cardPr.innerHTML = chunkGet[i].price;
            cardStk.innerHTML = chunkGet[i].stock;

            for (let listIdx = 0; listIdx < chunkGet[i].images.length; listIdx++) {
                if (chunkGet[i].images[listIdx].prod_img.image_id == 1) {
                    console.log('thumbnail');
                    cardImg.style.objectFit = 'cover';
                    cardImg.style.width = '100px';
                    cardImg.style.height = '100px';
                    cardImg.src = '/' + chunkGet[i].images[listIdx].prod_img.path;
                    cardBtn.dataset.thumbSrc = '/' + chunkGet[i].images[listIdx].prod_img.path;
                } else if (chunkGet[i].images[listIdx].prod_img.image_id == 2) {
                    const auxSrc = 'auxSrc' + imgCtr++;
                    cardBtn.dataset[auxSrc] = '/' + chunkGet[i].images[listIdx].prod_img.path
                }
            }

            cardBtn.classList.add('btn');
            cardBtn.dataset.bsToggle = 'modal';
            cardBtn.dataset.bsTarget = '#staticQikView';
            cardBtn.innerHTML = 'Quick View';
            cardBtn.dataset.row = prodWrapper.id;
            cardBtn.dataset.name = chunkGet[i].name;
            cardBtn.dataset.description = chunkGet[i].description;
            cardBtn.dataset.price = chunkGet[i].price;
            cardBtn.dataset.stock = chunkGet[i].stock;
            cardBtn.dataset.ref = chunkGet[i].reference;
            cardBtn.dataset.id = chunkGet[i].id;

            cardBtn.addEventListener('click', populateEl);

            cardDet.prepend(cardTit);
            cardDet.appendChild(cardPr);
            cardDet.appendChild(cardStk);
            cardBody.append(cardDet);

            cardCon.appendChild(cardImg);
            cardCon.appendChild(cardBody);
            cardCon.appendChild(cardBtn);

            prodWrapper.appendChild(cardCon);
            prodList.appendChild(prodWrapper);
        }
    }

    function changeRec(chg)
    {
        const selNumCon = document.getElementById(chg.target.id).children;

        for (let i of selNumCon) {
            if (i.value != 0 && i.selected) {
                getProd(1, i.value);
            }
        }
    }

    function populateEl()
    {
        console.log('POPULATE FN', this);

        const crselInr = document.getElementById('crselInr');
        crselInr.innerHTML = '';
        const prodSpec = document.getElementById('prodSpec');
        prodSpec.innerHTML = '';
        const prodForm = document.getElementById('prodForm');
        prodForm.addEventListener('submit', addOrd);
        const prodRef = document.getElementById('prodRef');
        prodRef.value = this.dataset.id;
        const prodQty = document.getElementById('prodQty');
        prodQty.setAttribute('max', this.dataset.stock);
        const navDesc = document.getElementById('nav-description');
        const navAbt = document.getElementById('nav-about');
        const navFAQ = document.getElementById('nav-faq');

        const thumbCon = document.createElement('div');
        thumbCon.classList.add('carousel-item', 'active', 'bg-danger');
        const thumbImg = document.createElement('img');
        thumbImg.style.height = '400px';
        thumbImg.style.width = '100%';
        thumbImg.style.objectFit = 'cover';
        thumbImg.classList.add('mx-auto', 'd-block');
        const prodTit = document.createElement('h3');
        const prodPr = document.createElement('h5');
        const prodStk = document.createElement('span');
        const prodDesc = document.createElement('p');

        prodTit.innerHTML = this.dataset.name;
        prodPr.innerHTML = this.dataset.price;
        prodStk.innerHTML = this.dataset.stock;
        prodDesc.innerHTML = this.dataset.description;

        for (let i in this.dataset) {
            if (i.startsWith('thumb')) {
                thumbImg.src = this.dataset[i];

                thumbCon.appendChild(thumbImg);
                crselInr.prepend(thumbCon);
            } else if (i.startsWith('aux')) {
                const auxCon = document.createElement('div');
                auxCon.classList.add('carousel-item');
                const auxImg = document.createElement('img');
                auxImg.style.width = '100%';
                auxImg.style.height = '400px';
                auxImg.style.objectFit = 'cover';
                auxImg.classList.add('mx-auto', 'd-block');
                auxImg.src = this.dataset[i];

                auxCon.appendChild(auxImg);
                crselInr.appendChild(auxCon);
            }
        }

        prodSpec.appendChild(prodTit);
        prodSpec.appendChild(prodPr);
        prodSpec.appendChild(prodStk);
        prodSpec.appendChild(prodDesc);
        navDesc.innerHTML = this.dataset.description;
        navAbt.innerHTML = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas quis orci id dolor porta vulputate. Praesent quis egestas dolor. Cras nisl enim, consectetur in sem ut, tristique fermentum diam. Pellentesque pellentesque, nisi sed blandit egestas, tellus ex scelerisque mi, a fringilla justo metus eu eros. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras sed tortor non massa rhoncus faucibus interdum at mi. Praesent at euismod orci. Nunc vestibulum sem quis mi vehicula lacinia in at mauris.';
        navFAQ.innerHTML = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas quis orci id dolor porta vulputate. Praesent quis egestas dolor. Cras nisl enim, consectetur in sem ut, tristique fermentum diam. Pellentesque pellentesque, nisi sed blandit egestas, tellus ex scelerisque mi, a fringilla justo metus eu eros. Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras sed tortor non massa rhoncus faucibus interdum at mi. Praesent at euismod orci. Nunc vestibulum sem quis mi vehicula lacinia in at mauris.';
    }

    function addOrd(ord)
    {
        ord.preventDefault();

        console.log('order: ', this);

        const cartParam = new FormData();

        cartParam.append('usr', this.prodUsr.value);
        cartParam.append('ref', this.prodRef.value);
        cartParam.append('qty', this.prodQty.value);

        axios.post(this.action, cartParam)

        .then(response => {
            console.log(response);
        })

        .catch(error => {
            console.log(error.response.data.errors);
        })
    }

    function rmvOrd()
    {
        console.log('rmv pls: ', this);

        const rmvOrdParam = new FormData();

        rmvOrdParam.append('usr', this.dataset.usr);
        rmvOrdParam.append('ref', this.dataset.ref);
        rmvOrdParam.append('id', this.dataset.id);

        axios.post('/products/cart/destroy', rmvOrdParam)

        .then(response => {
            console.log('response: ', response.data);
        })

        .catch(error => {
            console.log('error: ', error);
        })
    }

    function shopnCart()
    {
        console.log('shopn cartttt', this);

        const shopnCartPrnt = document.getElementById('shopnCart');
        shopnCartPrnt.innerHTML = '';
        const stWrp = document.createElement('row');
        const hRule = document.createElement('hr');
        const stLblCon = document.createElement('div');
        stLblCon.classList.add('col');
        const stLbl = document.createElement('span');
        const stAmtCon = document.createElement('div');
        stAmtCon.classList.add('col');
        const stAmt = document.createElement('span');
        let stDump = null;
        let st = null;

        axios.get('/products/cart/show')

        .then(response => {
            console.log('cart: ', response.data);
            const cartItems = response.data;

            for (let i in cartItems) {
                for (let j in cartItems[i]) {
                    console.log('j: ', j);
                    const listWrp = document.createElement('li');
                    listWrp.classList.add('list-group-item');
                    const listDiv = document.createElement('div');
                    listDiv.classList.add('row', 'justify-content-center', 'align-items-center');
                    const listLeftPnl = document.createElement('div');
                    listLeftPnl.classList.add('col-12', 'col-sm-9', 'align-self-sm-center');
                    const listLeftCtrl = document.createElement('div');
                    listLeftCtrl.classList.add('row', 'justify-content-center');

                    const listProdDetCon = document.createElement('div');
                    listProdDetCon.classList.add('col-12', 'col-sm-8');
                    const listProdDetCtrl = document.createElement('div');
                    listProdDetCtrl.classList.add('d-flex', 'flex-column');
                    const listProdImgCon = document.createElement('div');
                    listProdImgCon.classList.add('col-12', 'col-sm-4');
                    const listProdImg = document.createElement('img');
                    listProdImg.style.width = '100px';
                    listProdImg.style.height = '100px';
                    listProdImg.style.objectFit = 'cover';
                    listProdImg.classList.add('mx-auto', 'd-block');
                    const listProdDetTopWrp = document.createElement('div');
                    listProdDetTopWrp.classList.add('d-flex', 'flex-column', 'mt-2', 'mt-sm-0');
                    const listProdName = document.createElement('span');
                    const listProdPr = document.createElement('span');
                    const listProdQty = document.createElement('span');
                    listProdQty.classList.add('mt-2', 'mt-sm-4');

                    const listRightPnl = document.createElement('div');
                    listRightPnl.classList.add('col-12', 'col-sm-3', 'align-self-center');
                    const listRightCtrl = document.createElement('div');
                    listRightCtrl.classList.add('d-flex', 'flex-wrap', 'align-items-center', 'justify-content-between', 'p-2', 'flex-row-reverse', 'flex-sm-nowrap', 'flex-sm-column');
                    const listProdAmt = document.createElement('span');
                    listProdAmt.classList.add('mt-2');
                    const listProdDes = document.createElement('button');
                    listProdDes.classList.add('btn', 'text-danger', 'mt-0', 'mt-sm-5');

                    for (let k in cartItems[i][j]) {
                        if ((k !== 'thumb') && (k !== 'qty') && (k !== 'st')) {
                            listProdName.innerHTML = cartItems[i][j][k].name;
                            listProdPr.innerHTML = 'Price: ' + cartItems[i][j][k].price;
                            listProdDes.dataset.usr = cartItems[i][j][k].user_id;
                            listProdDes.dataset.id = cartItems[i][j][k].id;
                            listProdDes.dataset.ref = cartItems[i][j][k].reference;
                        }

                        if (k == 'thumb') {
                            listProdImg.src = '/' + cartItems[i][j][k];
                        }

                        if (k == 'qty') {
                            listProdQty.innerHTML = 'Qty: ' + cartItems[i][j][k];
                        }

                        if (k == 'st') {
                            st = cartItems[i][j][k];
                            stDump += st;
                            listProdAmt.innerHTML = '&#x20B1;' + st.toFixed(2);
                        }

                        listProdDes.innerHTML = 'Remove';
                        listProdDes.addEventListener('click', rmvOrd);
                    }

                    listProdDetTopWrp.prepend(listProdName);
                    listProdDetTopWrp.appendChild(listProdPr);
                    listProdDetCtrl.prepend(listProdDetTopWrp);
                    listProdDetCtrl.appendChild(listProdQty);
                    listProdDetCon.appendChild(listProdDetCtrl);
                    listProdImgCon.appendChild(listProdImg);
                    listLeftCtrl.prepend(listProdImgCon);
                    listLeftCtrl.appendChild(listProdDetCon);
                    listLeftPnl.appendChild(listLeftCtrl);
                    listRightCtrl.prepend(listProdAmt);
                    listRightCtrl.appendChild(listProdDes);
                    listRightPnl.appendChild(listRightCtrl);
                    listDiv.prepend(listLeftPnl);
                    listDiv.appendChild(listRightPnl);
                    listWrp.appendChild(listDiv);
                    shopnCartPrnt.prepend(listWrp);
                }
            }

            if (stDump) {
                stAmt.innerHTML = stDump.toFixed(2);
                stLbl.innerHTML = 'Subtotal:';

                stLblCon.appendChild(stLbl);
                stAmtCon.appendChild(stAmt);
                stWrp.prepend(stLblCon);
                stWrp.appendChild(stAmtCon);
                shopnCartPrnt.appendChild(stWrp);
            }
        })

        .catch(error => {
            console.log('err: ', error);
        })
    }
</script>
@endsection
