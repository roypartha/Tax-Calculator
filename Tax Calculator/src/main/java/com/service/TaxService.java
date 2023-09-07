package com.service;

import com.domain.Tax;

import java.util.List;

public interface TaxService {
    public Tax insert(Tax tax);
    public List<Tax> getAllByUsername(String username);
    public Tax calculateTax(Tax tax);
}
