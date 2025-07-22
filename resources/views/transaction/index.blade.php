@extends('layout.web')
@section('content')


<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="{{ asset('style/transaction.css') }}">
</head>
<body>
  
<div class="container">
  <div class="main-bg"><div class ="inner-bg"></div></div>

<a href="{{ route('account.index', ['cardNumber' => $account->CardNumber]) }}" class="btn-back">
    <i class="bi bi-chevron-left"></i>
</a>




    <a href="{{ route('kidzavings.index') }}">
      <div class="logo-circle"></div>
      <img src="{{ asset('images/kidz_logo.png') }}" class="logo" alt="Kidzania Logo">
    </a>

    <div class="transaction-header">
        <h1 class="transaction-title">My Transactions</h1>
        </div>


    <!-- Search Section -->
    {{-- <div class="search-section">
        <div class="search-container">
            <input type="text" class="search-bar" placeholder="Search transactions..." id="searchInput">
            <button class="filter-button" id="filterBtn"></button>
            <button class="filter-button" id="sortBtn"></button>
        </div>
    </div> --}}

    <!-- Transaction List -->
    <div class="transaction-list">
        @if($transaction->isEmpty())
            <div class="no-transactions">
                <p>No transactions found for Card: {{ $account->CardNumber }}</p>
            </div>
        @else
            @foreach($transaction as $txn)
                <div class="transaction-item {{ strtolower($txn->transactionType->Description) === 'deposit' || strtolower($txn->transactionType->Description) === 'deposited' ? 'deposit' : 'withdraw' }}">
                    <div class="transaction-date">
                        {{ \Carbon\Carbon::parse($txn->TransactionDate)->format('d M') }}
                    </div>
                    <div class="transaction-details">
                        <div class="transaction-amount">
                            {{ number_format($txn->Amount, 0) }}Z
                            <span class="transaction-type">
                                {{ strtolower($txn->transactionType->Description) }}
                            </span>
                        </div>
                        <div class="transaction-datetime">
                            {{ \Carbon\Carbon::parse($txn->TransactionDate)->format('d M Y, g:i a') }}
                        </div>
                    </div>
                    <div class="transaction-arrow"></div>
                </div>
            @endforeach
        @endif
    </div>

    <!-- Pagination -->
    @if($transaction->hasPages())
        <div class="pagination">
            @if($transaction->onFirstPage())
                <button class="pagination-nav prev" disabled></button>
            @else
                <a href="{{ $transaction->previousPageUrl() }}" class="pagination-nav prev"></a>
            @endif
            
            <div class="pagination-pages">
                @for($i = 1; $i <= min(3, $transaction->lastPage()); $i++)
                    <a href="{{ $transaction->url($i) }}" 
                       class="pagination-page {{ $transaction->currentPage() == $i ? 'active' : '' }}">
                        {{ $i }}
                    </a>
                @endfor
            </div>
            
            @if($transaction->hasMorePages())
                <a href="{{ $transaction->nextPageUrl() }}" class="pagination-nav next"></a>
            @else
                <button class="pagination-nav next" disabled></button>
            @endif
        </div>
    @endif

    <!-- Original table (hidden by CSS) -->
    <div style="display: none;">
        <h2>Transaction History for Card: {{ $account->CardNumber }}</h2>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Description</th>
                    <th>Amount (RM)</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transaction as $txn)
                    <tr>
                        <td>{{ $txn->IdTransaction }}</td>
                        <td>{{ $txn->transactionType->Description }}</td>
                        <td>{{ number_format($txn->Amount, 2) }}</td>
                        <td>{{ \Carbon\Carbon::parse($txn->TransactionDate)->format('d M Y H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
  </div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const transactionItems = document.querySelectorAll('.transaction-item');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        
        transactionItems.forEach(item => {
            const amount = item.querySelector('.transaction-amount').textContent.toLowerCase();
            const type = item.querySelector('.transaction-type').textContent.toLowerCase();
            const date = item.querySelector('.transaction-datetime').textContent.toLowerCase();
            
            if (amount.includes(searchTerm) || type.includes(searchTerm) || date.includes(searchTerm)) {
                item.style.display = 'flex';
            } else {
                item.style.display = 'none';
            }
        });
    });
    
    // Filter button functionality
    const filterBtn = document.getElementById('filterBtn');
    let filterState = 'all'; // all, deposit, withdraw
    
    filterBtn.addEventListener('click', function() {
        filterState = filterState === 'all' ? 'deposit' : 
                     filterState === 'deposit' ? 'withdraw' : 'all';
        
        transactionItems.forEach(item => {
            if (filterState === 'all') {
                item.style.display = 'flex';
            } else {
                if (item.classList.contains(filterState)) {
                    item.style.display = 'flex';
                } else {
                    item.style.display = 'none';
                }
            }
        });
        
        // Update button appearance
        filterBtn.style.background = filterState === 'all' ? '#FFFFFF' : 
                                   filterState === 'deposit' ? '#4DDD7B' : '#EE6759';
    });
    
    // Sort button functionality
    const sortBtn = document.getElementById('sortBtn');
    const transactionList = document.querySelector('.transaction-list');
    let sortOrder = 'desc'; // desc (newest first), asc (oldest first)
    
    sortBtn.addEventListener('click', function() {
        sortOrder = sortOrder === 'desc' ? 'asc' : 'desc';
        
        const items = Array.from(transactionItems);
        items.sort((a, b) => {
            const dateA = new Date(a.querySelector('.transaction-datetime').textContent);
            const dateB = new Date(b.querySelector('.transaction-datetime').textContent);
            
            return sortOrder === 'desc' ? dateB - dateA : dateA - dateB;
        });
        
        // Re-append sorted items
        items.forEach(item => transactionList.appendChild(item));
        
        // Update button appearance
        sortBtn.style.transform = sortOrder === 'desc' ? 'rotate(0deg)' : 'rotate(180deg)';
    });
    
    // Add click handlers for transaction items
    transactionItems.forEach(item => {
        item.addEventListener('click', function() {
            // You can add navigation to transaction details here
            console.log('Transaction clicked:', this);
        });
    });
});
</script>
</body>

@stop