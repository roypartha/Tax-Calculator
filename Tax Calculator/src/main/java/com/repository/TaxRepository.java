package com.repository;

import com.domain.Tax;

import java.util.List;

public interface TaxRepository {
    public List<Tax> list();
    public Tax get(Long id);
    public  List<Tax> getAllByUsername(String username);
    public Tax create(Tax tax);
    public Tax update(Tax tax);
    public boolean delete(Long id);
}
