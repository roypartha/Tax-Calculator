package com.controller;

import com.domain.User;
import com.exception.BadRequestAlertException;
import com.service.AdminService;
import org.springframework.beans.propertyeditors.StringTrimmerEditor;
import org.springframework.web.bind.WebDataBinder;
import org.springframework.web.bind.annotation.*;

import javax.validation.Valid;
import java.util.List;

@CrossOrigin()
@RestController
@RequestMapping("/admin")
public class AdminController {
    private AdminService adminService;

    public AdminController(AdminService adminService) {
        this.adminService = adminService;
    }

    @InitBinder
    public void initBinder(WebDataBinder webDataBinder) {
        StringTrimmerEditor stringTrimmerEditor = new StringTrimmerEditor(true);
        webDataBinder.registerCustomEditor(String.class, stringTrimmerEditor);
    }

    @GetMapping("/get-all-users")
    public List<User> getAllUsers() {
        List<User> users = adminService.getAllUsers();
        return users;
    }

    @PostMapping("/add-user")
    public String addUser(@Valid @RequestBody User user) {
        User newUser = adminService.insert(user);
        if (newUser.getId() == null) {
            return "Failed to add";
        }
        return "Added";
    }

    @PutMapping("/update-user")
    public String updateUser(@Valid @RequestBody User user) throws Exception {
        if (user.getId() == null) {
            throw new BadRequestAlertException("Invalid User ID");
        }
        adminService.update(user);
        return "Updated";
    }

    @DeleteMapping("/delete/{id}")
    public String deleteUser(@PathVariable Long id) {
        if (adminService.delete(id)) return "Deleted";
        else return "Failed to Delete";
    }
}
