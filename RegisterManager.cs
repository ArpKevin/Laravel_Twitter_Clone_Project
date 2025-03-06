using System.Collections;
using TMPro;
using UnityEngine;
using UnityEngine.SceneManagement;

public class RegisterManager : MonoBehaviour
{
    [Header("Register")]
    [SerializeField] TMP_InputField Reg_Email;
    [SerializeField] TMP_InputField Reg_Username;
    [SerializeField] TMP_InputField Reg_Password;
    [SerializeField] TMP_InputField Reg_Password_Repeat;
    [SerializeField] TextMeshProUGUI ErrorText;

    private void Start()
    {
        if (ErrorText != null)
        {
            ErrorText.text = "";
        }
    }

    public void OnRegisterPressed()
    {
        if (ErrorText != null)
        {
            ErrorText.text = "";
        }

        if (string.IsNullOrWhiteSpace(Reg_Email.text) || !IsValidEmail(Reg_Email.text))
        {
            ShowError("Please enter a valid email address!");
            return;
        }

        if (string.IsNullOrWhiteSpace(Reg_Username.text) || Reg_Username.text.Length < 3)
        {
            ShowError("Username must be at least 3 characters!");
            return;
        }

        if (string.IsNullOrWhiteSpace(Reg_Password.text) || Reg_Password.text.Length < 8)
        {
            ShowError("Password must be at least 8 characters!");
            return;
        }

        if (string.IsNullOrWhiteSpace(Reg_Password_Repeat.text))
        {
            ShowError("Please confirm your password!");
            return;
        }

        if (Reg_Password.text != Reg_Password_Repeat.text)
        {
            ShowError("Passwords do not match!");
            return;
        }

        StartCoroutine(RegisterUserCoroutine(Reg_Email.text, Reg_Username.text, Reg_Password.text));
    }

    private IEnumerator RegisterUserCoroutine(string email, string username, string password)
    {
        yield return StartCoroutine(DB_Manager.RegisterUser(email, username, password, (success, message) =>
        {
            if (success)
            {
                Debug.Log("Successfully registered!");
                SceneManager.LoadScene(1); // Make sure this scene index is correct for your login scene
            }
            else
            {
                ShowError($"Registration failed: {message}");
            }
        }));
    }

    private void ShowError(string message)
    {
        if (ErrorText != null)
        {
            ErrorText.text = message;
        }
        Debug.LogError(message);
    }

    private bool IsValidEmail(string email)
    {
        try
        {
            var addr = new System.Net.Mail.MailAddress(email);
            return addr.Address == email;
        }
        catch
        {
            return false;
        }
    }
}
