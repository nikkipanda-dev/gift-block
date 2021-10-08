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
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropAdr">
                        New address
                    </button>

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
                        <div>
                            <button type="submit" class="btn btn-primary">Add to cart</button>
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

<script>
    window.addEventListener('load', custProd);

    function custProd()
    {
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
        console.log('EHEHEH', this);

        const crselInr = document.getElementById('crselInr');
        crselInr.innerHTML = '';
        const prodSpec = document.getElementById('prodSpec');
        prodSpec.innerHTML = '';
        const prodForm = document.getElementById('prodForm');
        prodForm.addEventListener('submit', addOrd);
        const prodRef = document.getElementById('prodRef');
        prodRef.value = this.dataset.id;
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

        axios.post(this.action, cartParam)

        .then(response => {
            console.log(response);
        })

        .catch(error => {
            console.log(error.response.data.errors);
        })
    }
</script>
@endsection
