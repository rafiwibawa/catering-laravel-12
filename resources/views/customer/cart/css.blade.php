

<style>
  .payment-section {
    background: #fff;
    padding: 1.5rem;
    border-radius: 12px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  }

  .payment-option .form-check {
    transition: all 0.3s ease;
    background: #fff;
  }

  .payment-option .form-check:hover {
    background: #f8f9fa;
    border-color: #ffc107 !important;
    transform: translateX(5px);
  }

  .payment-option .form-check-input:checked + .form-check-label {
    color: #ffc107;
  }

  .bank-selection {
    animation: slideDown 0.3s ease;
  }

  .bank-selection .form-check {
    background: #f8f9fa;
    border-radius: 8px;
    transition: all 0.2s ease;
  }

  .bank-selection .form-check:hover {
    background: #fff;
    transform: translateX(5px);
  }

  .bank-selection .form-check-input:checked + .form-check-label {
    color: #ffc107;
    font-weight: 600;
  }

  @keyframes slideDown {
    from {
      opacity: 0;
      transform: translateY(-10px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .fa-chevron-up {
    transform: rotate(180deg);
    transition: transform 0.3s ease;
  }

  .fa-chevron-down {
    transition: transform 0.3s ease;
  }
</style>

<style>
    :root {
      --primary: #4f46e5;
      --primary-dark: #3730a3;
      --success: #10b981;
      --warning: #f59e0b;
      --danger: #ef4444;
      --gray-50: #f9fafb;
      --gray-100: #f3f4f6;
      --gray-200: #e5e7eb;
      --gray-300: #d1d5db;
      --gray-400: #9ca3af;
      --gray-500: #6b7280;
      --gray-600: #4b5563;
      --gray-700: #374151;
      --gray-800: #1f2937;
      --gray-900: #111827;
    }
    
    .cart_section {
      background: #ffffff;
      min-height: 100vh;
    }
    
    /* Header Styles */
    .cart-header {
      color: rgb(0, 0, 0);
    }
    
    .cart-icon {
      width: 80px;
      height: 80px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto;
      backdrop-filter: blur(10px);
    }
    
    .cart-icon i {
      font-size: 2.5rem;
      color: white;
    }
    
    /* Cart Items Container */
    .cart-items-container {
      background: white;
      border-radius: 24px;
      padding: 2rem;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    }
    
    .section-header {
      border-bottom: 2px solid var(--gray-100);
      padding-bottom: 1rem;
    }
    
    .section-title {
      display: flex;
      align-items: center;
      gap: 1rem;
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--gray-800);
      margin: 0;
    }
    
    .title-icon {
      width: 48px;
      height: 48px;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
    }
    
    .item-count {
      background: var(--primary);
      color: white;
      padding: 0.25rem 0.75rem;
      border-radius: 20px;
      font-size: 0.875rem;
      margin-left: auto;
    }
    
    /* Cart Item Styles */
    .cart-item {
      display: flex;
      gap: 1.5rem;
      padding: 2rem 0;
      border-bottom: 1px solid var(--gray-200);
      transition: all 0.3s ease;
    }
    
    .cart-item:hover {
      transform: translateY(-2px);
      background: var(--gray-50);
      margin: 0 -1rem;
      padding-left: 1rem;
      padding-right: 1rem;
      border-radius: 16px;
    }
    
    .cart-item:last-child {
      border-bottom: none;
    }
    
    .item-image {
      width: 120px;
      height: 120px;
      border-radius: 16px;
      overflow: hidden;
      flex-shrink: 0;
    }
    
    .item-image img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.3s ease;
    }
    
    .cart-item:hover .item-image img {
      transform: scale(1.05);
    }
    
    .image-placeholder {
      width: 100%;
      height: 100%;
      background: var(--gray-200);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--gray-400);
      font-size: 2rem;
    }
    
    .item-details {
      flex: 1;
      min-width: 0;
    }
    
    .item-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 0.5rem;
    }
    
    .item-name {
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--gray-800);
      margin: 0;
      line-height: 1.4;
    }
    
    .btn-remove {
      background: none;
      border: none;
      color: var(--gray-400);
      padding: 0.5rem;
      border-radius: 8px;
      transition: all 0.3s ease;
      cursor: pointer;
    }
    
    .btn-remove:hover {
      background: var(--danger);
      color: white;
      transform: scale(1.1);
    }
    
    .item-description {
      color: var(--gray-600);
      margin-bottom: 1.5rem;
      line-height: 1.5;
    }
    
    .item-controls {
      display: grid;
      grid-template-columns: 1fr 1fr 1fr;
      gap: 2rem;
      align-items: end;
    }
    
    .price-section, .quantity-section, .total-section {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }
    
    .price-label, .quantity-label, .total-label {
      font-size: 0.875rem;
      color: var(--gray-500);
      font-weight: 500;
    }
    
    .unit-price, .item-total {
      font-size: 1.125rem;
      font-weight: 700;
      color: var(--gray-800);
    }
    
    .item-total {
      color: var(--success);
    }
    
    /* Quantity Controls */
    .quantity-controls {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      background: var(--gray-100);
      border-radius: 12px;
      padding: 0.25rem;
      width: fit-content;
    }
    
    .quantity-btn {
      width: 36px;
      height: 36px;
      border: none;
      background: white;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: all 0.3s ease;
      color: var(--gray-600);
    }
    
    .quantity-btn:hover {
      background: var(--primary);
      color: white;
      transform: scale(1.1);
    }
    
    .quantity-input {
      width: 50px;
      text-align: center;
      border: none;
      background: transparent;
      font-weight: 600;
      color: var(--gray-800);
      font-size: 1rem;
    }
    
    /* Checkout Sidebar */
    .checkout-sidebar {
      position: sticky;
      top: 2rem;
    }
    
    .summary-card, .payment-card {
      background: white;
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      margin-bottom: 2rem;
    }
    
    .card-header {
      background: linear-gradient(135deg, var(--success), #059669);
      color: white;
      padding: 1.5rem 2rem;
    }
    
    .payment-card .card-header {
      background: linear-gradient(135deg, var(--warning), #d97706);
    }
    
    .card-header h3 {
      margin: 0;
      font-size: 1.25rem;
      font-weight: 600;
    }
    
    .card-body {
      padding: 2rem;
    }
    
    /* Summary Styles */
    .summary-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 0.75rem 0;
      color: var(--gray-700);
    }
    
    .summary-divider {
      height: 1px;
      background: var(--gray-200);
      margin: 1rem 0;
    }
    
    .summary-total {
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 1.25rem;
      font-weight: 700;
      color: var(--gray-800);
      padding: 1rem 0;
    }
    
    .summary-total span:last-child {
      color: var(--success);
    }
    
    /* Payment Methods */
    .payment-category {
      margin-bottom: 2rem;
    }
    
    .category-title {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      font-size: 1.125rem;
      font-weight: 600;
      color: var(--gray-800);
      margin-bottom: 1rem;
    }
    
    .category-title i {
      color: var(--primary);
    }
    
    .payment-options {
      display: flex;
      flex-direction: column;
      gap: 0.75rem;
    }
    
    .payment-option {
      cursor: pointer;
      display: block;
    }
    
    .payment-option input {
      display: none;
    }
    
    .option-content {
      display: flex;
      align-items: center;
      gap: 1rem;
      padding: 1rem;
      border: 2px solid var(--gray-200);
      border-radius: 12px;
      transition: all 0.3s ease;
      background: white;
    }
    
    .payment-option:hover .option-content {
      border-color: var(--primary);
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(79, 70, 229, 0.15);
    }
    
    .payment-option input:checked + .option-content {
      border-color: var(--primary);
      background: linear-gradient(135deg, rgba(79, 70, 229, 0.05), rgba(79, 70, 229, 0.1));
    }
    
    .payment-option input:checked + .option-content .check-icon {
      color: var(--primary);
      opacity: 1;
    }
    
    .bank-logo, .ewallet-logo, .qris-logo {
      width: 48px;
      height: 48px;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--gray-100);
      flex-shrink: 0;
    }
    
    .bank-logo img {
      width: 32px;
      height: 32px;
      object-fit: contain;
    }
    
    .ewallet-logo {
      font-size: 0.75rem;
      font-weight: 700;
      color: white;
    }
    
    .ewallet-logo.dana { background: #118EEA; }
    .ewallet-logo.ovo { background: #4C3494; }
    .ewallet-logo.gopay { background: #00AED6; }
    .ewallet-logo.shopeepay { background: #EE4D2D; }
    
    .qris-logo {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      font-size: 1.5rem;
    }
    
    .bank-info {
      flex: 1;
      display: flex;
      flex-direction: column;
    }
    
    .bank-name {
      font-weight: 600;
      color: var(--gray-800);
      font-size: 1rem;
    }
    
    .bank-type {
      font-size: 0.875rem;
      color: var(--gray-500);
    }
    
    .check-icon {
      color: var(--gray-300);
      font-size: 1.25rem;
      opacity: 0.3;
      transition: all 0.3s ease;
    }
    
    /* Checkout Button */
    .btn-checkout {
      width: 100%;
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      border: none;
      border-radius: 16px;
      padding: 1.25rem 2rem;
      font-size: 1.125rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      justify-content: space-between;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-top: 2rem;
    }
    
    .btn-checkout:disabled {
      background: var(--gray-300);
      cursor: not-allowed;
      transform: none;
    }
    
    .btn-checkout:not(:disabled):hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(79, 70, 229, 0.3);
    }
    
    .btn-checkout:not(:disabled):active {
      transform: translateY(0);
    }
    
    .btn-icon {
      font-size: 1.25rem;
    }
    
    .btn-amount {
      font-weight: 700;
      font-size: 1.25rem;
    }
    
    /* Empty Cart */
    .empty-cart {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 60vh;
    }
    
    .empty-cart-content {
      text-align: center;
      background: white;
      padding: 4rem 3rem;
      border-radius: 24px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
      max-width: 500px;
    }
    
    .empty-icon {
      width: 120px;
      height: 120px;
      background: linear-gradient(135deg, var(--gray-200), var(--gray-300));
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 2rem;
    }
    
    .empty-icon i {
      font-size: 3rem;
      color: var(--gray-400);
    }
    
    .empty-cart h2 {
      color: var(--gray-800);
      margin-bottom: 1rem;
      font-size: 2rem;
      font-weight: 700;
    }
    
    .empty-cart p {
      color: var(--gray-600);
      margin-bottom: 2rem;
      font-size: 1.125rem;
      line-height: 1.6;
    }
    
    .btn-browse-menu {
      background: linear-gradient(135deg, var(--primary), var(--primary-dark));
      color: white;
      text-decoration: none;
      padding: 1rem 2rem;
      border-radius: 12px;
      font-weight: 600;
      display: inline-flex;
      align-items: center;
      transition: all 0.3s ease;
    }
    
    .btn-browse-menu:hover {
      transform: translateY(-2px);
      box-shadow: 0 12px 28px rgba(79, 70, 229, 0.3);
      color: white;
      text-decoration: none;
    }
    
    /* Responsive Design */
    @media (max-width: 1200px) {
      .item-controls {
        grid-template-columns: 1fr;
        gap: 1rem;
      }
      
      .price-section, .quantity-section, .total-section {
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
      }
    }
    
    @media (max-width: 768px) {
      .cart_section {
        padding: 2rem 0;
      }
      
      .cart-items-container,
      .card-body {
        padding: 1.5rem;
      }
      
      .cart-item {
        flex-direction: column;
        text-align: center;
      }
      
      .item-image {
        align-self: center;
      }
      
      .item-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
      }
      
      .quantity-controls {
        align-self: center;
      }
      
      .checkout-sidebar {
        position: static;
        margin-top: 2rem;
      }
    }
    
    @media (max-width: 576px) {
      .empty-cart-content {
        padding: 2rem 1.5rem;
      }
      
      .empty-icon {
        width: 80px;
        height: 80px;
      }
      
      .empty-icon i {
        font-size: 2rem;
      }
      
      .empty-cart h2 {
        font-size: 1.5rem;
      }
      
      .btn-checkout {
        flex-direction: column;
        gap: 0.5rem;
        text-align: center;
      }
      
      .btn-amount {
        font-size: 1.5rem;
      }
    }
    </style>