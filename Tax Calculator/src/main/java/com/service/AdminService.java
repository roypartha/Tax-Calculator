package com.service;

import com.domain.User;

import java.util.List;

public interface AdminService {
    public List<User> getAllUsers();
    public User insert(User user);
    public User update(User user);
    public boolean delete(Long id);
}
