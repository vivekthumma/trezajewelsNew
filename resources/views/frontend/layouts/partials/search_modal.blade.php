<!-- search-modal start -->
<div class="search-modal modal fade" id="searchmodal">
    <div class="modal-dialog mw-100 m-0">
        <div class="modal-content body-bg border-0 rounded-0">
            <div class="modal-body p-0">
                <div class="container">
                    <div class="search-content ptb-30">
                        <div class="search-box d-flex flex-row-reverse">
                            <button type="button" class="d-block search-close body-secondary-color icon-16" data-bs-dismiss="modal" aria-label="Close"><i class="ri-close-large-line d-block lh-1"></i></button>
                            <form method="get" action="{{ route('products') }}" class="search-form w-100">
                                <div class="search-bar position-relative">
                                    <div class="form-search d-flex flex-row-reverse">
                                        <input type="search" name="search" class="search-input w-100 h-auto ptb-0 plr-15 bg-transparent border-0" value="{{ request('search') }}" placeholder="Search here" required>
                                        <button type="submit" class="d-block search-btn body-secondary-color icon-16" aria-label="Go to search"><i class="ri-search-line d-block lh-1"></i></button>
                                    </div>
                                    <div class="d-none search-results position-absolute top-100 start-0 end-0 body-bg z-1 border-full border-radius box-shadow">
                                        <div class="search-for ptb-10 plr-15 beb">Search for <span class="search-text"></span></div>
                                        <ul class="search-ul" id="search-results-list">
                                            <!-- Results will be loaded here via AJAX if implemented -->
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="search-example-text mst-15">Trending search: rings, necklaces, etc.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- search-modal end -->
