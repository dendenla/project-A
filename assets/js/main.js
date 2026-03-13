/* ============================================
   MAIN.JS - Interactivity & Functionality
   ============================================ */

document.addEventListener('DOMContentLoaded', function() {
    initMobileMenu();
    initBackToTop();
    initSearch();
    initFormValidation();
    initSmoothScroll();
});

// ============ Mobile Menu Toggle ============
function initMobileMenu() {
    const toggle = document.querySelector('.mobile-toggle');
    const menu = document.querySelector('.nav-menu');
    
    if (!toggle || !menu) return;
    
    toggle.addEventListener('click', function(e) {
        e.stopPropagation();
        menu.classList.toggle('active');
        toggle.classList.toggle('active');
    });
    
    // Close menu when clicking on a link
    menu.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function() {
            menu.classList.remove('active');
            toggle.classList.remove('active');
        });
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.navbar')) {
            menu.classList.remove('active');
            toggle.classList.remove('active');
        }
    });
}

// ============ Back to Top Button ============
function initBackToTop() {
    // Create button if it doesn't exist
    if (!document.getElementById('backToTop')) {
        const btn = document.createElement('button');
        btn.id = 'backToTop';
        btn.innerHTML = '↑';
        btn.title = 'Kembali ke atas';
        document.body.appendChild(btn);
    }
    
    const btn = document.getElementById('backToTop');
    
    window.addEventListener('scroll', function() {
        if (window.scrollY > 300) {
            btn.classList.add('show');
        } else {
            btn.classList.remove('show');
        }
    });
    
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
}

// ============ Search Functionality ============
function initSearch() {
    const searchInputs = document.querySelectorAll('[data-search]');
    
    searchInputs.forEach(input => {
        input.addEventListener('input', debounce(function(e) {
            const query = e.target.value.toLowerCase().trim();
            const targetSelector = input.dataset.search;
            const items = document.querySelectorAll(targetSelector);
            
            if (query === '') {
                items.forEach(item => item.style.display = '');
            } else {
                items.forEach(item => {
                    const text = item.textContent.toLowerCase();
                    item.style.display = text.includes(query) ? '' : 'none';
                });
            }
        }, 300));
    });
}

// ============ Form Validation ============
function initFormValidation() {
    const forms = document.querySelectorAll('form[data-validate]');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const isValid = validateForm(this);
            if (!isValid) {
                e.preventDefault();
                showErrors(this);
            }
        });
    });
}

function validateForm(form) {
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    let isValid = true;
    
    inputs.forEach(input => {
        if (input.type === 'email') {
            isValid = validateEmail(input.value) && isValid;
        } else if (input.value.trim() === '') {
            isValid = false;
        }
    });
    
    return isValid;
}

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

function showErrors(form) {
    const inputs = form.querySelectorAll('input[required], textarea[required]');
    inputs.forEach(input => {
        if (input.value.trim() === '') {
            input.style.borderColor = '#e53e3e';
            input.style.backgroundColor = '#fee2e2';
        }
    });
}

// ============ Smooth Scroll ============
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#' && document.querySelector(href)) {
                e.preventDefault();
                document.querySelector(href).scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
}

// ============ Utility Functions ============

// Debounce function
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Throttle function
function throttle(func, limit) {
    let inThrottle;
    return function(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Add loading state to forms
function showLoading(button) {
    button.disabled = true;
    button.innerHTML = '<span class="loading"></span> Loading...';
}

function hideLoading(button, text) {
    button.disabled = false;
    button.innerHTML = text || 'Kirim';
}

// Toast notification
function showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `alert alert-${type}`;
    toast.textContent = message;
    toast.style.position = 'fixed';
    toast.style.top = '20px';
    toast.style.right = '20px';
    toast.style.zIndex = '9999';
    toast.style.maxWidth = '400px';
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.animation = 'fadeOut 300ms ease-out forwards';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Modal functionality
function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.style.display = 'flex';
        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('active');
        setTimeout(() => {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }, 300);
    }
}

// Fade out animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(20px);
        }
    }
`;
document.head.appendChild(style);

// Navbar scroll effect
const navbar = document.querySelector('.navbar');
if (navbar) {
    window.addEventListener('scroll', throttle(function() {
        if (window.scrollY > 10) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    }, 100));
}

// Export functions for use in HTML
window.showToast = showToast;
window.openModal = openModal;
window.closeModal = closeModal;
window.showLoading = showLoading;
window.hideLoading = hideLoading;
