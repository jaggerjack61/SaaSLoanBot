<div class="card mb-4">
    <h5 class="card-header">Time Period</h5>
    <div class="card-body">

        <div class="m-1 row">
            <label for="html5-date-input" class="col-md-1 col-form-label">Start Date</label>
            <div class="col-md-3">
                <input class="form-control" type="date" wire:model="start" value="2021-06-18" id="html5-date-input" />
            </div>
            <label for="html5-date-input" class="col-md-1 col-form-label">End Date</label>
            <div class="col-md-3">
                <input class="form-control" wire:model="end" type="date" value="2021-06-18" id="html5-date-input" />
            </div>
            <label for="html5-date-input" class="col-md-1 col-form-label">Currency</label>
            <div class="col-md-3">
                <select class="form-control" wire:model="currency">
                    <option value="none">None</option>
                    <option value="">All</option>
                    <option value="USD">USD</option>
                    <option value="RTGS">ZWL/RTGS</option>
                </select>
            </div>
        </div>


    </div>
</div>
